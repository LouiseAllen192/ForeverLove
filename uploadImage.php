<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>Image Upload Status</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom_gallery.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/classes/User.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/classes/ImageService.php');



    $me;
    $uid;
    if(!empty($_POST)){
        if(isset($_POST['uid'])){
            $uid = $_POST['uid'];
        }
        if(isset($_POST['me'])){
            $me = $_POST['me'];
        }

    }
    $images = ImageService::getImages($uid);



    ?>




</head>

<body class="full">
<?php include("includes/navbar.php"); ?>

<!--Main page content-->
<div class="container">

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <br><br><br>
                <hr>
                <h2 class="intro-text text-center">Image Upload Status</h2>
                <hr>
                <hr class="visible-xs">
                <br>



                <?php

                    if(!empty($_POST)) {
                        $infoMsgInfo = ImageService::uploadFileImage($_FILES, $uid, $images);
                    }

                ?>


                <br><br><br>


                    <div class= "alert alert-<?php echo $infoMsgInfo['type'];?>" role="alert">
                        <a href="galleryPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $infoMsgInfo['msg'];?>
                    </div>



                    <br><br><br><br><br><br>
                    <br><br><br><br><br><br>


                    <form action="galleryPage.php" method="post">
                        <input type="hidden" name="uid" value="<?php echo $uid?>">
                        <input type="hidden" name="me" value="<?php echo $me?>">
                        <button type="submit" name="goBack" class="btn btn-info buttons_left" >Back to Image Gallery <span class="glyphicon glyphicon-picture"></span></button>
                    </form>


                <br><br><br><br><br><br>



                    </div>
                </div>
                <br><br><br><br>
            </div>
        </div>
    </div>

</div>

<?php include("includes/footer.html"); ?>
</body>

</html>