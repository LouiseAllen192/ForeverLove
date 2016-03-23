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
    <script src="scripts/profileCarousel.js"></script>
    <?php include("includes/fonts.html"); ?>

    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/classes/User.php');

    //hardcoded array of image urls - to be changed to urls from database
    $images = array("0"=>"http://placehold.it/150x150&text=zero", "1"=> "http://placehold.it/150x150&text=1", "2"=> "http://placehold.it/150x150&text=2", "3"=> "http://placehold.it/150x150&text=3",
        "4"=> "http://placehold.it/150x150&text=4", "5"=> "http://placehold.it/150x150&text=5", "6"=> "http://placehold.it/150x150&text=6",
        "7"=> "http://placehold.it/150x150&text=7", "8"=> "http://placehold.it/150x150&text=8", "9"=> "http://placehold.it/150x150&text=9",
        "10"=> "http://placehold.it/150x150&text=10", "11"=> "http://placehold.it/150x150&text=11", "12"=> "http://placehold.it/150x150&text=12",
        "13"=> "http://placehold.it/150x150&text=13", "14"=> "http://placehold.it/150x150&text=14", "15"=> "http://placehold.it/150x150&text=15",
        "16"=> "http://all4desktop.com/data_images/original/4240423-people.jpg");


    $me;
    $uid;
//    user id will come either from $_SESSION['user_id'] (if viewing your own profile)
//    or $_POST[] if viewing someone elses page
//    if(!empty($_POST)){
//        $uid = $_POST['uid'];
//        $me=false;
//    }
//    else{
//        $uid = $_SESSION['user_id'];
//        $me=true;
//    }

        $me=true;
        $uid = 1;

        $user = new User($uid);
        $dbprf = $user->getUserPrefrences();
        $hobNames = ReturnShortcuts::returnHobbyNames();
        $dbhob = $user->getHobbies();

    function calculateAge($dob){
    $birthDate = explode("-", $dob);
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
        ? ((date("Y") - $birthDate[0]) - 1)
        : (date("Y") - $birthDate[0]));
    echo $age;
    }

    function createDisplay($name, $dbhob){
        $html = '<'.'div class="col-md-4">'.'<'.'small class="text-muted">';
        $html.= ucwords(str_replace('_', ' ', $name)).'&emsp;</small>'.getFieldData($name, $dbhob).'</div>';
        echo $html;
    }

    function getFieldData($name, $array){
        if($array[$name] == '1'){
            return '<'.'div class="col-md-2">'.'<span class="glyphicon glyphicon-ok"></span>'.'</div>';
        }
        if($array[$name] == '0'){
            return '<'.'div class="col-md-2">'.'<span class="glyphicon glyphicon-remove"></span>'.'</div>';
        }
        else{
            return ($array[$name]);
        }
    }


    function createSlides($images){
        foreach($images as $key=>$image) {
            if ($key == "0") {
                echo '<'.'div class="item active">
                         <img src="'.$image.'" alt="image zero">
                        </div>';
            } else {
                echo '<'.'div class="item ">
                         <img src="'.$image.'" alt="image '.$key.'">
                        </div>';
            }
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
                <br><br><br>
                    <div class = "row">

                        <div class="col-md-5 col-sm-6 text-center">
                            <div class="profile-pic"><img src="includes/pics/default-profile.png" class="img-responsive" alt="Profile Picture"></div>
                            <br><br>

                        </div>

                        <div class="col-md-5 col-sm-6 text-center">
                            <div class = "panel panel-default">
                                <div class = "panel-body">
                                    <br><br>
                                    <h1 class="user-name"><?php echo ($user->getUsername());?></h1>
                                    <hr class="tagline-divider">
                                    <h2>
                                        <small>
                                            <strong><?php echo ($dbprf['tag_line'])?></strong>
                                        </small>
                                    </h2>
                                    <br><br>
                                    <div class = "row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="col-md-4">
                                                <small class="text-muted">Age&emsp;</small><?php echo calculateAge($dbprf['date_of_birth']); ?>
                                            </div>
                                            <br><br>
                                            <div class="col-md-4">
                                                <small class="text-muted">City&emsp;</small><?php echo $dbprf['city'];?>
                                            </div>
                                            <br><br>
                                            <div class="col-md-4">
                                                <small class="text-muted">Gender&emsp;</small><?php echo $dbprf['gender'];?>
                                            </div>
                                            <div style="clear:both;"><div></div></div>
                                            <br><br>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-6 text-center">
                            <div class = buttons_right>
                                <?php
                                if($me){
                                    echo '<'.'br><a href="updatePreferencesPage.php" class="btn btn-info center-inline" role="button">Edit Preferences</a>';
                                    echo '<'.'br><br><a href="updateHobbiesPage.php" class="btn btn-info center-inline" role="button">Edit Hobbies</a>';
                                }
                                else{
                                    echo '<a href="reportUserPage.php" class="btn btn-info center-inline" role="button">Report this user</a>';
                                }
                                ?>
                            </div>
                        </div>

                    </div>

                    <br><br>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Image Gallery</h2>
                    <hr>
                    <hr class="visible-xs">
                    <br>

                            <div class = "row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="carouselBox">
                                        <div class = "button_center">
                                        <a href="galleryPage.php" class="btn btn-info center-inline" role="button">Go to Image Gallery  <span class="glyphicon glyphicon-picture"></span></a>
                                        </div>
                                            <br><br>


                                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <?php
                                                createSlides($images);
                                                ?>
                                            </div>
                                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-4"></div>

                            </div>

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

                                    <?php
                                    createDisplay("height", $dbprf);
                                    createDisplay("ethnicity", $dbprf);
                                    createDisplay("body_type", $dbprf);
                                    ?>
                                    <div style="clear:both;"><div></div></div><br>
                                    <?php
                                    createDisplay("seeking", $dbprf);
                                    createDisplay("religion", $dbprf);
                                    ?>
                                    <div class="col-md-4">
                                        <small class="text-muted">Smoker:&emsp;</small><?php echo ($dbprf['smoker'])==1 ? 'Yes' : 'No'
                                            // echo ($user->getUserPreferences()->getSmoker())==1 ? 'Yes' : 'No';?>
                                    </div>
                                    <div style="clear:both;"><div></div></div><br>
                                    <?php
                                    createDisplay("intent", $dbprf);
                                    createDisplay("has_children", $dbprf);
                                    createDisplay("drinker", $dbprf);
                                    ?>
                                    <div style="clear:both;"><div></div></div><br>
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