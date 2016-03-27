<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>View Image</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-view-image.css" rel="stylesheet">
    <script src="scripts/gallery.js"></script>

    <?php include("includes/fonts.html");
    include($_SERVER['DOCUMENT_ROOT'] . '/classes/User.php');


    $me;
    $uid;
    $imageNum;

    foreach($_POST as $key=>$value){
        if(endsWith($key, '_x')){
            $imageNum = (string)$key;
            $imageNum = str_replace('_x', '', $imageNum);
        }
        if($key == "me"){
            $me = $value;
        }
        if($key == 'uid'){
            $uid = $value;
        }
        if($key == 'imgNum'){
            $imageNum = $value;
        }
    }

    $images = ImageService::getImages($uid);

    function endsWith($word, $x) {
        return $x === "" || (($temp = strlen($word) - strlen($x)) >= 0 && strpos($word, $x, $temp) !== false);
    }


    ?>




</head>

<body class="full">
<?php include("includes/navbar.html"); ?>

<!--Main page content-->
<div class="container">

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <br>
                <hr>
                <h2 class="intro-text text-center">View Image</h2>
                <hr>
                <hr class="visible-xs">
                <br>

                <?php if($me){ ?>
                <form action="viewImagePage.php" method="post">
                <input type="hidden" name="uid" value="<?php echo $uid?>">
                <input type="hidden" name="me" value="<?php echo $me?>">
                <input type="hidden" name="imgNum" value="<?php echo $imageNum?>">

                <div class="btn-group myButtonsLeft">
                    <button type="submit" name="submit" class="btn btn-primary" Value="Delete" >Delete Image</button>
                </div>
                    <div class="btn-group myButtonsRight">
                        <button type="submit" name="submit"  class="btn btn-primary" Value="ProfilePic" >Set as Profile Picture</button>
                    </div>
                </form>
                <?php } ?>

                <?php
                if(isset($_POST['submit'])) {
                    if ($_POST['submit'] == "Delete") {
                        $success = ImageService::deleteImage($imageNum, $uid);
                        if($success){
                            $alertType = "success";
                            $alertMsg = "Image deleted successfully";
                        }
                        else{
                            $alertType = "warning";
                            $alertMsg = "Image was not successfully deleted. Please try again";
                        }
                    }
                    if ($_POST['submit'] == "ProfilePic") {
                        $success = ImageService::updateProfileImage($imageNum, $uid);
                        if($success){
                            $alertType = "success";
                            $alertMsg = "Profile picture successfully updated";
                        }
                        else{
                            $alertType = "warning";
                            $alertMsg = "Profile picture not successfully updated. Please try again";
                        }
                    }?>
                            <br><br><br><br>
                             <div class= "alert alert-<?php echo $alertType?>" role="alert">
                            <a href="galleryPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $alertMsg?>
                            </div>
                <?php }
                ?>


                <br><br><br><br>
                <?php
                if(isset($_POST['submit'])) {
                    if ($_POST['submit'] != "Delete" && $_POST['submit'] != "ProfilePic") {
                        echo '<img src="'.$images[$imageNum].'" class="img-responsive">';
                    }
                }
                else{ ?>
                    <img src="<?php echo $images[$imageNum]?>" class="img-responsive">
                <?php }
                ?>


                <br><br><br><br>

                <form action="galleryPage.php" method="post">
                    <input type="hidden" name="uid" value="<?php echo $uid?>">
                    <input type="hidden" name="me" value="<?php echo $me?>">
                    <button type="submit" name="goBack" class="btn btn-info center-block" >Back to Image Gallery <span class="glyphicon glyphicon-picture"></span></button>
                </form>


            </div>
        </div>
    </div>

</div>

<?php include("includes/footer.html"); ?>

</body>

</html>