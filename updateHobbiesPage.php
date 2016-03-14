<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>Update Hobbies</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>



    <?php
    include($_SERVER['DOCUMENT_ROOT'].'/classes/UserServiceMgr.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/ReturnShortcuts.php');

    //$uid = $_GLOBAL['User_Id'];
    $uid = 2;
    $dbvalue = ReturnShortcuts::returnHobbies($uid);

    if(!empty($_POST)){
        $success = UserServiceMgr::updateUserHobbies($uid, $_POST);
    }

    function createOption($name, $dbvalue){
        $html = '<div class="col-md-4"'.'>'.'<div class="form-group">'. '<label class="checkbox-inline">';
        $html .= '<input type="checkbox" name="'.$name.'" id="'.$name.'"'.checked($name, $dbvalue).'>';
        $html .= str_replace('_', ' ', $name);
        $html .= '</label></div></div>';
        echo $html;
    }

    function checked($name, $dbvalue){
        return ($dbvalue[$name] == 1 ? 'checked' : '');
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
                        <strong>Update Hobbies</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <br>

                <?php
                if(!empty($_POST)) {
                    if ($success) {
                        echo '<' . 'div class= "alert alert-success" role="alert">
                                    <a href="settingsPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        Hobbies updated successfully
                                    </div>';
                    } else {
                        echo '<' . 'div class="alert alert-danger">
                                    <a href="settingsPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Error</strong> - Hobbies update was unsuccessful
                             </div>';
                    }
                }
                ?>

                <form role ="form" class="form-inline" action="updateHobbiesPage.php" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>

                                <?php
                                createOption('Reading', $dbvalue);
                                createOption("Cinema", $dbvalue);
                                createOption("Shopping", $dbvalue);
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Socializing", $dbvalue);
                                createOption("Travelling", $dbvalue);
                                createOption("Walking", $dbvalue);
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Exercise", $dbvalue);
                                createOption("Soccer", $dbvalue);
                                createOption("Dancing", $dbvalue);
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Horses", $dbvalue);
                                createOption("Painting", $dbvalue);
                                createOption("Running", $dbvalue);
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Eating_Out", $dbvalue);
                                createOption("Cooking", $dbvalue);
                                createOption("Computers", $dbvalue);
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Bowling", $dbvalue);
                                createOption("Writing", $dbvalue);
                                createOption("Skiing", $dbvalue);
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Crafts", $dbvalue);
                                createOption("Golf", $dbvalue);
                                createOption("Chess", $dbvalue);
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Gymnastics", $dbvalue);
                                createOption("Cycling", $dbvalue);
                                createOption("Swimming", $dbvalue);
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Surfing", $dbvalue);
                                createOption("Hiking", $dbvalue);
                                createOption("Video_Games", $dbvalue);
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Volleyball", $dbvalue);
                                createOption("Badminton", $dbvalue);
                                createOption("Gym", $dbvalue);
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Parkour", $dbvalue);
                                createOption("Fashion", $dbvalue);
                                createOption("Yoga", $dbvalue);
                                ?>
                                <div style="clear:both;"><div></div>
                                    <?php
                                    createOption("Basketball", $dbvalue);
                                    createOption("Boxing", $dbvalue);
                                    ?>
                            </fieldset>
                            <br>
                            <fieldset class="form-group">
                                <label for="uniqueHobbyLabel">Unique Hobby</label>
                                <input type="text"  name="Unique_Hobbie" class="form-control" maxlength="256"  placeholder="Enter new unique hobby"><br /><br>
                            </fieldset>
                        </div>
                        <div style="clear:both;"><div></div></div>
                    </div>
                    <br><br>
                    <input type="submit" name="Send" class="btn btn-primary" Value="Apply Changes">
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
