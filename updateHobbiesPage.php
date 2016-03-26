<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include($_SERVER['DOCUMENT_ROOT'].'/classes/UserServiceMgr.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/ReturnShortcuts.php');


    $uid = $_SESSION['user_id'];
    $uid = 5;

    $regOrUpdate = UserServiceMgr::determineUpdateOrReg($uid);
    $dbvalue=array();

    if($regOrUpdate == "Update"){
        $dbvalue = ReturnShortcuts::returnHobbies($uid);
    }

    $hobbyNames = ReturnShortcuts::returnHobbyNames();
    ?>

    <title><?php echo $regOrUpdate?> Hobbies</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

    <?php
    if(!empty($_POST)){
        $success = UserServiceMgr::updateUserHobbies($uid, $_POST);
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
                        <strong><?php echo $regOrUpdate?> Hobbies</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <br>

                <?php
                if(!empty($_POST)) {
                    $dbvalue = ReturnShortcuts::returnHobbies($uid);
                    if ($regOrUpdate == "Register" && $success) {
                        echo '<' . 'div class= "alert alert-success" role="alert">
                                    <a href="homePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    Registration completed successfully
                                    </div>';
                        sleep(5);
                        header('Location: ' . 'homePage.php');
                        die();
                    }
                    if ($regOrUpdate == "Update" && $success) {
                        echo '<' . 'div class= "alert alert-success" role="alert">
                                    <a href="homePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    Hobby Details updated successfully
                                    </div>';
                    }
                    if (!$success) {
                        echo '<' . 'div class="alert alert-danger">
                                <a href="UpdateHobbiesPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Error</strong> - Hobby details update was unsuccessful
                                </div>';
                    }
                }
                ?>

                <form role ="form" class="form-inline" action="updateHobbiesPage.php" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            function createOption($name, $dbvalue, $regOrUpdate){
                                $html = '<div class="col-md-4"'.'>'.'<div class="form-group">'. '<label class="checkbox-inline">';
                                $html .= '<input type="checkbox" name="'.$name.'" id="'.$name.'"'.checked($name, $dbvalue,  $regOrUpdate).'>';
                                $html .= ucwords(str_replace('_', ' ', $name));
                                $html .= '</label></div></div>';
                                echo $html;
                            }

                            function checked($name, $dbvalue, $regOrUpdate){
                                if($regOrUpdate == "Register"){
                                    return '';
                                }
                                return ($dbvalue[$name] == 1 ? 'checked' : '');
                            }
                            ?>

                            <fieldset>
                                <?php
                                for($i=1; $i<count($hobbyNames)-1; $i++){
                                    createOption($hobbyNames[$i], $dbvalue, $regOrUpdate);
                                    if($i % 3 ==0){
                                        echo '<'.'div style="clear:both;"><div></div></div>';
                                    }
                                }
                                ?>
                            </fieldset>

                            <br>
                            <fieldset class="form-group">
                                <label for="uniqueHobbyLabel">Unique Hobby</label>
                                <input type="text"  name="unique_hobby" class="form-control" maxlength="256"  placeholder="<?php echo isset($dbvalue['unique_hobby']) ? $dbvalue['unique_hobby'] : "Enter new unique hobby"?>"><br /><br>
                            </fieldset>
                        </div>
                        <div style="clear:both;"><div></div></div>
                    </div>
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
