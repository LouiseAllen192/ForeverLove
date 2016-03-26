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

    <?php include("includes/fonts.html"); ?>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/classes/User.php');

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

    $me=false;
    $uid = 1;
    $images = ImageService::getImages($uid);

    function endsWith($word, $x) {
        return $x === "" || (($temp = strlen($word) - strlen($x)) >= 0 && strpos($word, $x, $temp) !== false);
    }



    $imageNum;
        foreach($_POST as $key=>$value){
            if(endsWith($key, '_x')){
                $imageNum = (string)$key;
                $imageNum = str_replace('_x', '', $imageNum);
            }
            if($value == "Delete" || $value == "ProfilePic"){
                $imageNum = $key;
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
            <div class="col-lg-12">
                <br>
                <hr>
                <h2 class="intro-text text-center">View Image</h2>
                <hr>
                <hr class="visible-xs">
                <br>

                <form action="viewImagePage.php" method="post">
                <div class="btn-group myButtonsLeft">
                    <button type="submit" name="<?php echo $imageNum?>" class="btn btn-primary" Value="Delete" >Delete Image</button>
                </div>
                    <div class="btn-group myButtonsRight">
                        <button type="submit" name="<?php echo $imageNum?>"  class="btn btn-primary" Value="ProfilePic" >Set as Profile Picture</button>
                    </div>
                </form>

                <?php
                if(isset($_POST[$imageNum])) {
                    if ($_POST[$imageNum] == "Delete") {
                        $success = ImageService::deleteImage($imageNum);
                        if($success){
                            $alertType = "success";
                            $alertMsg = "Image deleted successfully";
                        }
                        else{
                            $alertType = "warning";
                            $alertMsg = "Image was not successfully deleted. Please try again";
                        }
                    }
                    if ($_POST[$imageNum] == "ProfilePic") {
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
                                 <br><br><a href="galleryPage.php"><button type="button" name="Back to gallery" class="btn btn-primary" Value="Back to gallery">Back to gallery</button></a>
                            </div>
                <?php }
                ?>


                <br><br><br><br>
                <?php
                if(isset($_POST[$imageNum])) {
                    if ($_POST[$imageNum] != "Delete" && $_POST[$imageNum] != "ProfilePic") {
                        echo '<img src="<?php echo $images[$imageNum]?>" class="img-responsive">';
                    }
                }
                else{ ?>
                    <img src="<?php echo $images[$imageNum]?>" class="img-responsive">
                <?php }
                ?>

            </div>
        </div>
    </div>

</div>

<?php include("includes/footer.html"); ?>

</body>

</html>