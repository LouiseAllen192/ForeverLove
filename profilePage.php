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

//    user id will come either from $_SESSION['user_id'] (if viewing your own profile)
//    or $_POST[] if viewing someone elses page

        $uid = 1;

        $user = new User($uid);
        $dbprf = $user->getUserPrefrences();
        $hobNames = ReturnShortcuts::returnHobbyNames();
        $dbhob = $user->getHobbies();

        function calculateAge($dob){
        $birthDate = "02/19/1991";
        $birthDate = explode("/", $birthDate);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
        echo $age;
    }

    function createDisplay($name, $dbhob){
        $html = '<'.'div class="col-md-4">'.'<'.'small class="text-muted">';
        $html.= str_replace('_', ' ', $name).'&emsp;</small>'.getFieldData($name, $dbhob).'</div>';
        echo $html;
    }

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
                            <strong><?php echo ($dbprf['tag_line'])?></strong>
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
                                        <small class="text-muted">Age&emsp;</small><?php echo (calculateAge($dbprf['date_of_birth'])) // echo (calculateAge($user->getUserPreferences()->getDateob()));?>
                                    </div>
                                    <?php
                                    createDisplay("city", $dbprf);
                                    createDisplay("height", $dbprf);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("gender", $dbprf);
                                    createDisplay("ethnicity", $dbprf);
                                    createDisplay("body_type", $dbprf);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("seeking", $dbprf);
                                    createDisplay("religion", $dbprf);
                                    ?>
                                    <div class="col-md-4">
                                        <small class="text-muted">Smoker:&emsp;</small><?php echo ($dbprf['smoker'])==1 ? 'Yes' : 'No'
                                            // echo ($user->getUserPreferences()->getSmoker())==1 ? 'Yes' : 'No';?>
                                    </div>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("intent", $dbprf);
                                    createDisplay("has_children", $dbprf);
                                    createDisplay("drinker", $dbprf);
                                    ?>
                                    <div style="clear:both;"><div></div></div>
                                    <?php
                                    createDisplay("marital_status", $dbprf);
                                    createDisplay("wants_children", $dbprf);
                                    ?>
                                    <div class="col-md-4">
                                        <small class="text-muted">Income:&emsp;</small><?php echo ($dbprf['income'])// echo ($user->getUserPreferences()->getIncome());?>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class = "panel panel-default">
                                <div class = "panel-body">
                                    <small class="text-muted">About me:&emsp;</small><?php echo ($dbprf['about_me']) // echo ($user->getUserPreferences()->getAboutMe()); ?>
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
                                    for($i=1; $i<count($hobNames); $i++){
                                        $name= $hobNames[$i];
                                        createDisplay($name, $dbhob);
                                            if($i % 3 ==0){
                                            echo '<'.'div style="clear:both;"><div></div></div>';
                                            }
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class = "panel panel-default">
                                <div class = "panel-body">
                                    <small class="text-muted">Unique Hobby&emsp;</small><?php echo $user->getUniqueHobby() // echo ($user->getUserPreferences()->getAboutMe()); ?>
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