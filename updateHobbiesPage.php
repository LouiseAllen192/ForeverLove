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

    //code to be executed after submit button pressed
    if(!empty($_GET)){
        $changes = array();

        $keys = array('Reading','Cinema','Shopping','Socializing','Travelling',
            'Walking','Exercise','Soccer','Dancing', 'Horses','Running','Eating_Out',
            'Painting', 'Cooking', 'Computers', 'Bowling', 'Writing', 'Skiing', 'Crafts',
            'Golf', 'Chess', 'Gymnastics','Cycling','Swimming','Surfing','Hiking','Video_Games',
            'Volleyball','Badminton','Gym','Parkour','Fashion','Yoga','Basketball','Boxing', 'Unique_Hobbie');

        for($i=0; $i<count($keys) ; $i++){
            if(!isset ($_GET[$keys[$i]])) {
                $changes[$keys[$i]] = "0";
            } else {
                $changes[$keys[$i]] = "1";
            }
        }

        if(isset ($_GET['Unique_Hobbie'])){ $changes['Unique_Hobbie'] = $_GET['Unique_Hobbie'];}
        if($changes['Unique_Hobbie']== ''){ unset($changes['Unique_Hobbie']);}


        $success = UserServiceMgr::testFunction($changes);

        //this wont work until database is sorted and working
        //$success = UserServiceMgr::updateUserHobbies($userid, $changes);
    }

    // All to be uncommented and used when database is working/populated
    //    $dbvalue = ReturnShortcuts::returnHobbies($uid);

    //hardcoded array to be replaced with users values from db
    $dbvalue = array("Reading"=>"1", "Cinema"=>"0", "Shopping"=>"0", "Socializing"=>"1", "Travelling"=>"0", "Walking"=>"1",
        "Exercise"=>"1", "Soccer"=>"0", "Dance"=>"1", "Horses"=>"1", "Painting"=>"0", "Running"=>"0",
        "Eat_Out"=>"0", "Cooking"=>"0", "Computers"=>"0", "Bowling"=>"1", "Writing"=>"0", "Skiing"=>"1",
        "Crafts"=>"1", "Golf"=>"1", "Chess"=>"1", "Gymnastics"=>"1", "Cycle"=>"1", "Swimming"=>"1",
        "Surfing"=>"1", "Hiking"=>"0", "Video_Games"=>"1", "Volly_Ball"=>"1", "Badminton"=>"1", "Gym"=>"1",
        "Parkour"=>"0", "Fashion"=>"1", "Yoga"=>"1", "Basketball"=>"0", "Boxing"=>"0", "Unique_Hobbie"=>"Cutting Turf");

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
                if(!empty($_GET)) {
                    if ($success) {
                        echo '<' . 'div class= "alert alert-success" role="alert">
                                    <a href="settingsPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        Account Details updated successfully
                                    </div>';
                    } else {
                        echo '<' . 'div class="alert alert-danger">
                                    <a href="settingsPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Error</strong> - Account Details update was unsuccessful
                             </div>';
                    }
                }
                ?>

                <form role ="form" class="form-inline" action="updateHobbiesPage.php" method="get">
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
                                createOption("Dance", $dbvalue);
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Horses", $dbvalue);
                                createOption("Painting", $dbvalue);
                                createOption("Running", $dbvalue);
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Eat_Out", $dbvalue);
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
                                createOption("Cycle", $dbvalue);
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
                                createOption("Volly_Ball", $dbvalue);
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
