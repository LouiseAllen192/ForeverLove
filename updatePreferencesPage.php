<!DOCTYPE html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include($_SERVER['DOCUMENT_ROOT'].'/classes/UserServiceMgr.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/ReturnShortcuts.php');

    $uid = $_SESSION['user_id'];

    $regOrUpdate = UserServiceMgr::determineUpdateOrReg($uid);

    $dbvalue=array();

    if($regOrUpdate == "Update"){
        $dbvalue = ReturnShortcuts::returnPreferences($uid);
    }

    ?>

    <title><?php echo $regOrUpdate?> Preferences</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <?php include("includes/fonts.html");?>

    <?php
        if(!empty($_POST)){
                $success = UserServiceMgr::updateUserPreferences($uid, $_POST, $regOrUpdate);
        }
    ?>


</head>

<body class="full">
<?php include("includes/navbar.html"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong><?php echo $regOrUpdate?> Prefrences</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                    <br>
                    <?php
                    if(!empty($_POST)) {
                        if ($regOrUpdate == "Register" && $success) {
                            $dbvalue = ReturnShortcuts::returnPreferences($uid);
                            header('Location: ' . 'updateHobbiesPage.php');
                            die();
                        }
                        if ($regOrUpdate == "Update" && $success) {
                            $dbvalue = ReturnShortcuts::returnPreferences($uid);
                            echo '<' . 'div class= "alert alert-success" role="alert">
                                    <a href="homePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    Preference Details updated successfully
                                    </div>';
                        }
                        if (!$success) {
                            echo '<' . 'div class="alert alert-danger">
                                <a href="UpdatePreferencesPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Error</strong> - Preferences details update was unsuccessful
                                </div>';
                        }
                    }
                    ?>
                <form id="prefrences" action="updatePreferencesPage.php" id="updateP" method="POST">
                    <fieldset class="form-group">
                        <label for="tag_line">Tag Line</label>
                        <input type="text"  class="form-control" maxlength="256" name="tag_line" placeholder= "<?php echo isset($dbvalue['tag_line']) ? $dbvalue['tag_line'] : "Enter tagline here"?>" ><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="city">City</label>
                        <input type="text"  class="form-control" maxlength="64" name="city" placeholder="<?php echo isset($dbvalue['city']) ? $dbvalue['city'] : "Enter city here"?>"><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <?php
                            function generateSelect($name, $dbvalue, $regOrUpdate) {
                                if($regOrUpdate == "Update")$default= $dbvalue[$name];
                                else $default = "Unselected";

                                $options = ReturnShortcuts::returnOptionNames($name);

                                $html = '<'.'fieldset class="form-group">';
                                $html .= '<'.'label for="'.$name.'Label">'.ucwords(str_replace('_', ' ', $name)).'</label>';
                                $html .= '<select name="'.$name.'" class="form-control">';
                                foreach ($options as $option) {
                                    if ($option == $default) {
                                        $html .= '<option selected='.'"selected">'.$option.'</option>';
                                    } else {
                                        $html .= '<option'.'>'.$option.'</option>';
                                    }
                                }
                                $html .= '<'.'/select><br><br></fieldset>';
                                echo $html;
                            }

                            $attributes = array("gender", "seeking", "intent", "height", "ethnicity", "body_type", "religion", "marital_status",
                                "income", "has_children", "wants_children", "smoker", "drinker" );

                            for($i=0; $i<count($attributes);$i++){
                                generateSelect($attributes[$i], $dbvalue, $regOrUpdate);
                            }
                        ?>
                    <fieldset class="form-group">
                        <label for="about_me">About Me</label>
                        <textarea class="form-control" name="about_me" id= "about_me" rows="3"><?php ?><?php echo isset($dbvalue['about_me']) ? $dbvalue['about_me'] : "Tell us about yourself"?></textarea><br />
                    </fieldset>
                    <br><br>
                    <input type="submit" name="Send" class="btn btn-primary" Value="<?php echo $regOrUpdate?> Changes">
                </form>

                    <br><br>
                    <br><br>
                </p>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>