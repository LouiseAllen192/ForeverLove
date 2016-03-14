<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>Profile Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-profile.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/classes/User.php');

//    $uid = $GLOBALS['User_Id'];
        $uid = 1;
        $user = new User($uid);
        $dbhob = $user->getHobbies();
        $dbprf = $user->getUserPrefrences();

        function calculateAge($dob){
        //date in mm/dd/yyyy format; or it can be in other formats as well
        $birthDate = "02/19/1991";
        //explode the date to get month, day and year
        $birthDate = explode("/", $birthDate);
        //get age from date or birthdate
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
        echo $age;
    }

    function createDisplay($name, $array){
        $html = '<'.'div class="col-md-4">'.'<'.'small class="text-muted">';
        $html.= str_replace('_', ' ', $name).'&emsp;</small>'.getFieldData($name, $array).'</div>';
        echo $html;
        // To be changed to:  echo ($user->getUserPreferences()->getX());
    }

    //to be changed to access values through getters
    function getFieldData($name, $array){
        if($array[$name] == '1'){
            return '<'.'div class="col-md-2">'.'<img src="includes/pics/tick.png" class="img-rounded" alt="tick" width="20" height="20">'.'</div>';
        }
        if($array[$name] == '0'){
            return '<'.'div class="col-md-2">'.'<img src="includes/pics/cross.png" class=img-rounded" alt="cross" width="20" height="20">'.'</div>';
        }
        else{
            return ($array[$name]);
        }

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
                    <!--image source to be got from database-->
                    <div class="profile-pic"><img src="includes/pics/ProfilePic.jpg" class="img-responsive" alt="Profile Picture"></div>
                    <br><br>
                    <h1 class="user-name"><?php echo ($user->getUsername());?></h1>
                    <hr class="tagline-divider">
                    <h2>
                        <small>
                            <strong><?php echo ($dbprf['Tag_Line'])?></strong>
                        </small>
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">All about me</h2>
                    <hr>
                    <hr class="visible-xs">
                    <br>
                    <div class="row">
                        <div class="col-md-12">

                            <div class = "panel panel-default">
                                <div class = "panel-body">

                                    <div class="col-md-4">
                                        <small class="text-muted">Age&emsp;</small><?php echo (calculateAge($dbprf['Date_Of_Birth'])) // echo (calculateAge($user->getUserPreferences()->getDateob()));?>
                                    </div>
                                    <?php
                                    createDisplay("City", $dbprf);
                                    createDisplay("Height", $dbprf);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Gender", $dbprf);
                                    createDisplay("Ethnicity", $dbprf);
                                    createDisplay("Body_Type", $dbprf);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Seeking", $dbprf);
                                    createDisplay("Religion", $dbprf);
                                    ?>
                                    <div class="col-md-4">
                                        <small class="text-muted">Smoker:&emsp;</small><?php echo ($dbprf['Smoker'])==1 ? 'Yes' : 'No'
                                            // echo ($user->getUserPreferences()->getSmoker())==1 ? 'Yes' : 'No';?>
                                    </div>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Intent", $dbprf);
                                    ?>
                                    <div class="col-md-4">
                                        <small class="text-muted">Has Children:&emsp;</small><?php echo ($dbprf['Has_Children'])// echo ($user->getUserPreferences()->getHasChildren());?>
                                    </div>
                                    <?php
                                    createDisplay("Drinker", $dbprf);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Marital_Status", $dbprf);
                                    ?>
                                    <div class="col-md-4">
                                        <small class="text-muted">Wants Children:&emsp;</small><?php echo ($dbprf['Wants_Children'])==1 ? 'Yes' : 'No'
                                            // echo ($user->getUserPreferences()->getWantsChildren())==1 ? 'Yes' : 'No' ;?>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted">Income:&emsp;</small><?php echo ($dbprf['Income'])// echo ($user->getUserPreferences()->getIncome());?>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class = "panel panel-default">
                                <div class = "panel-body">
                                    <small class="text-muted">About me:&emsp;</small><?php echo ($dbprf['About_Me']) // echo ($user->getUserPreferences()->getAboutMe()); ?>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
        </div>
            <?php // echo ($dbvalue['Shopping']==1 ? 'checked' : '');?>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Intrests & Hobbies</h2>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">

                            <div class = "panel panel-default">
                                <div class = "panel-body">

                                    <?php
                                    createDisplay("Reading", $dbhob);
                                    createDisplay("Cinema", $dbhob);
                                    createDisplay("Shopping", $dbhob);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Socializing", $dbhob);
                                    createDisplay("Travelling", $dbhob);
                                    createDisplay("Walking", $dbhob);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Exercise", $dbhob);
                                    createDisplay("Soccer", $dbhob);
                                    createDisplay("Dancing", $dbhob);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Horses", $dbhob);
                                    createDisplay("Painting", $dbhob);
                                    createDisplay("Running", $dbhob);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Eating_Out", $dbhob);
                                    createDisplay("Cooking", $dbhob);
                                    createDisplay("Computers", $dbhob);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Bowling", $dbhob);
                                    createDisplay("Writing", $dbhob);
                                    createDisplay("Skiing", $dbhob);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Crafts", $dbhob);
                                    createDisplay("Golf", $dbhob);
                                    createDisplay("Chess", $dbhob);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Gymnastics", $dbhob);
                                    createDisplay("Cycling", $dbhob);
                                    createDisplay("Swimming", $dbhob);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Surfing", $dbhob);
                                    createDisplay("Hiking", $dbhob);
                                    createDisplay("Video_Games", $dbhob);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Volleyball", $dbhob);
                                    createDisplay("Badminton", $dbhob);
                                    createDisplay("Gym", $dbhob);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Parkour", $dbhob);
                                    createDisplay("Fashion", $dbhob);
                                    createDisplay("Yoga", $dbhob);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("Basketball", $dbhob);
                                    createDisplay("Boxing", $dbhob);
                                    ?>

                                </div>
                            </div>

                            <div class = "panel panel-default">
                                <div class = "panel-body">
                                    <small class="text-muted">Unique Hobby&emsp;</small><?php echo ($dbhob['Unique_Hobbie']) // echo ($user->getUserPreferences()->getAboutMe()); ?>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
    <?php include("includes/footer.html"); ?>
</body>

</html>