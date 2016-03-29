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

    $me;
    $uid;

    $uid = $_SESSION['user_id'];
    $me = true;

    /*if(isset($_GET['uid'])){
        $uid = $_GET['uid'];
        $me=false;
    }
    else{
        $uid = $_SESSION['user_id'];
        $me=true;
    }*/

        $images = ImageService::getImages($uid);

        $user = new User($uid);
        $dbprf = $user->getUserPrefrences();
        $hobNames = ReturnShortcuts::returnHobbyNames();
        $dbhob = $user->getHobbies();

    function calculateAge($dob){
    $birthDate = explode("-", $dob);
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
        ? ((date("Y") - $birthDate[0]) - 1)
        : (date("Y") - $birthDate[0]));
    return $age;
    }

    function createDisplay($name, $dbhob){
        echo '<div class="col-md-4">'.'<'.'small class="text-muted">'.
        ucwords(str_replace('_', ' ', $name)).'&emsp;</small>'.getFieldData($name, $dbhob).'</div>';
    }

    function getFieldData($name, $array){
        if($array[$name] == '1'){
            return '<div class="col-md-2">'.'<span class="glyphicon glyphicon-ok"></span>'.'</div>';
        }
        if($array[$name] == '0'){
            return '<div class="col-md-2">'.'<span class="glyphicon glyphicon-remove"></span>'.'</div>';
        }
        else{
            return ($array[$name]);
        }
    }


    function createSlides($images){
        foreach($images as $key=>$image) {
            if($image != ''){
                if ($key == "1") {
                    echo '<div class="item active">
                         <img src="'.$image.'" alt="image 1">
                        </div>';
                } else {
                    echo '<div class="item ">
                         <img src="'.$image.'" alt="image '.$key.'">
                        </div>';
                }
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
                            <br><br>
                            <div class="profile-pic"><img src="<?php echo $images['1']?>" class="img-responsive" alt="Profile Picture"></div>
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
                                    echo '<br><a href="updatePreferencesPage.php" class="btn btn-info center-inline" role="button"><span class="glyphicon glyphicon-heart-empty"></span> Edit Preferences</a>'.
                                        '<br><br><a href="updateHobbiesPage.php" class="btn btn-info center-inline" role="button"><span class="glyphicon glyphicon-knight"></span> Edit Hobbies</a>';
                                }
                                else{
                                    $MsgMgr = new MessageMgr($_SESSION['user_id']);
                                    ?>
                                    <form action ="#", method="post">
                                    <a href="reportUserPage.php" class="btn btn-info center-inline" role="button"><span class="glyphicon glyphicon-remove-circle"></span> Report this user</a>
                                    <?php  $MsgMgr->sendMessageButton($uid); ?>
                                    </form>

                                <?php }
                                ?>
                            </div>
                        </div>

                    </div>

                    <br><br>

                </div>
            </div>
        </div>

        <div class = "row">
            <div class="col-md-6">
                <div class="row">
                    <div class="boxLeft box">
                        <div class="col-lg-12">
                            <hr>
                            <h2 class="intro-text text-center">Image Gallery</h2>
                            <hr>
                            <hr class="visible-xs">
                            <br>

                            <div class = "row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="carouselBox">
                                        <div class = "button_center">
                                            <form action="galleryPage.php" method="post">
                                                    <input type="hidden" name="uid" value="<?php echo $uid?>">
                                                    <input type="hidden" name="me" value="<?php echo $me?>">
                                                    <button type="submit" name="submit" class="btn btn-info" >Go to Image Gallery <span class="glyphicon glyphicon-picture"></span></button>
                                            </form>
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
                                <div class="col-md-2"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="boxRight box">
                        <div class="col-lg-12">
                            <hr>
                            <h2 class="intro-text text-center">About Me:</h2>
                            <hr>
                            <hr class="visible-xs">
                            <br>
                            <div class = "panel panel-default panel-stretch">
                                <div class = "panel-body">
                                    <small class="text-muted"><?php echo ($dbprf['about_me'])  ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>








        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">My Details</h2>
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
                                        <small class="text-muted">Smoker:&emsp;</small><?php echo ($dbprf['smoker'])==1 ? 'Yes' : 'No'?>
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
                                        <small class="text-muted">Income:&emsp;</small><?php echo ($dbprf['income'])?>
                                    </div>
                                </div>
                            </div>
                            <br>

                        </div>
                    </div>


                </div>
            </div>
        </div>


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
                                    <small class="text-muted">Unique Hobby&emsp;</small><?php echo $user->getUniqueHobby() ?>
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