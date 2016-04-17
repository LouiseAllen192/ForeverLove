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
        include($_SERVER['DOCUMENT_ROOT'].'/classes/ImageService.php');
        include($_SERVER['DOCUMENT_ROOT'].'/classes/DB.php');
        include($_SERVER['DOCUMENT_ROOT'].'/classes/Config.php');
        include($_SERVER['DOCUMENT_ROOT'].'/classes/ReturnShortcuts.php');
        include($_SERVER['DOCUMENT_ROOT'].'/classes/BrowserHelper.php');

    $me; //will be 1-for me, 2-for not me, 3-for admin
    $uid;
    $admin;

    if(isset($_SESSION['permissions'])){
        if($_SESSION['permissions'] == "admin"){
            $admin = true;
            if(isset($_GET['uid'])){
                $uid = $_GET['uid'];
            }
            $me = 3;
        }
        else{
            if(isset($_GET['uid'])){
                $uid = $_GET['uid'];
                $me = 2;
                $admin = false;
            }
            else{
                $uid = $_SESSION['user_id'];
                $me = 1;
                $admin = false;
            }
        }
    }
    else{
        echo 'unset permissions';
    }

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

    <?php if(!$admin) {include("includes/navbar.php");}
    else {include("includes/navbarAdmin.html");}?>

    <!--Main page content-->
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12 text-center">


                    <div class="col-md-4 col-sm-6 text-center">
                        <div class="text-center">
                            <div class="special">
                                <div class="v-m">
                                    <div class="profile-pic"><br><img src="<?php echo $images['1']?>" class="img-responsive" alt="Profile Picture"></div>
                                </div>
                            </div>
                        </div>
                    </div>





<!--                        col for preferences-->
                        <div class="col-md-8 col-sm-10 text-center">

                            <div class="row">

                                <div class="col-md-8"><br><br>
                                    <div class = "panel panel-default panel-asl">
                                        <div class = "panel-body"><br>
                                            <h3 class="user-name"><?php echo ($user->getUsername());?></h3>
                                            <hr class="tagline-divider">
                                            <h5>
                                                <small>
                                                    <strong><?php echo ($dbprf['tag_line'])?></strong>
                                                </small>
                                            </h5><br>
                                            <div class = "row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6"><small class="text-muted">Age </small></div>
                                                        <div class="col-md-6"><?php echo calculateAge($dbprf['date_of_birth']); ?></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6"><small class="text-muted">City </small></div>
                                                        <div class="col-md-6"><?php echo $dbprf['city'];?></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6"><small class="text-muted">Gender </small></div>
                                                        <div class="col-md-6"><?php echo $dbprf['gender'];?></div>
                                                    </div><br><br>

                                                </div>
                                                <div class="col-md-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="buttons_right" >
                                        <?php echo '<br><br>';
                                        if($me == 1){
                                            echo '<a href="updatePreferencesPage.php" class="btn btn-info center-inline" role="button"><span class="glyphicon glyphicon-heart-empty"></span> Edit Preferences</a>'.
                                                '<br><br><a href="updateHobbiesPage.php" class="btn btn-info center-inline" role="button"><span class="glyphicon glyphicon-knight"></span> Edit Hobbies</a>';
                                        }
                                        if($me == 3){ ?>
                                            <div class = "admin_notice">
                                                <p><h4>Admin notice:</h4><br>If users preferences or hobbies contains any offensive material. Remove here:</p>
                                                <a href="updatePreferencesPage.php?admin=true&uid=<?php echo $uid;?>" class="btn btn-danger center-inline" role="button"><span class="glyphicon glyphicon-heart-empty"></span> Edit Preferences</a>
                                                <br><br><a href="updateHobbiesPage.php?admin=true&uid=<?php echo $uid;?>" class="btn btn-danger center-inline" role="button"><span class="glyphicon glyphicon-knight"></span> Edit Hobbies</a>
                                            </div>
                                        <?php }
                                        if($me==2){
                                            $MsgMgr = new MessageMgr($_SESSION['user_id']);
                                            ?>
                                            <form action ="#", method="post">
                                                <?php  $MsgMgr->sendMessageButton($uid); ?>
                                            </form>

                                        <?php } ;
                                        ?>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
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
                            </div>



                        </div>


                    </div>
                    <br><br>

                </div>
            </div>


        <div class = "row side_by_side">
            <div class="col-md-6">
                <div class="row">
                    <div class="boxLeft box">
                        <div class="col-lg-12">
                            <hr><h2 class="intro-text text-center">Image Gallery</h2><hr>
                            <hr class="visible-xs"><br>
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
                                                <?php createSlides($images); ?>
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


            <?php if($me == 2){?>
                <a href="reportUserPage.php?uid=<?php echo $user->getUserId()?>" class="btn btn-danger center-inline" role="button"><span class="glyphicon glyphicon-remove-circle"></span> Report this user</a>
                <br><br><br><br><br>
            <?php }

            if($me == 3){
                if(DB::getInstance()->query("SELECT user_id FROM banned_users WHERE user_id = '$uid'")->count()){?>
                    <a href="secret_location/removeBanPage.php?report_id=0&uid=<?php echo $uid;?>" class="btn btn-danger center-inline" role="button"><span class="glyphicon glyphicon-remove-circle"></span> Remove Ban</a>
                    <br><br><br><br><br>
                    <?php
                }
                else{?>
                <a href="secret_location/banUserPage.php?report_id=0&uid=<?php echo $user->getUserId()?>" class="btn btn-danger center-inline" role="button"><span class="glyphicon glyphicon-remove-circle"></span> Ban this user</a>
                <br><br><br><br><br>
                <?php
                }
            }

            ?>



        </div>


    </div>
    <?php include("includes/footer.html"); ?>
</body>

</html>