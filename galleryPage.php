<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>Gallery Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom_gallery.css" rel="stylesheet">
    <script src="scripts/gallery.js"></script>

    <?php include("includes/fonts.html"); ?>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/classes/User.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/classes/ImageService.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/DB.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/Config.php');


    $me; //will be 1-for me, 2-for not me, 3-for admin
    $uid;
     if(!empty($_POST)){
         if(isset($_POST['me'])){
             $me = $_POST['me'];
         }
         if(isset($_POST['uid'])){
             $uid = $_POST['uid'];
         }

     }


    $images = ImageService::getImages($uid);


    function createThumbnails($images){
        foreach($images as $img_num=>$img_url) {
            if ($img_url != "") {
                echo ' <li class = "col-sm-3">
                            <a class="thumbnail" id="carousel-selector-\'.$img_num.\'">
                                <input type="image" name = "'.$img_num.'" src="'.$img_url.'" class = "imgButton">
                            </a>
                       </li>';
            }
        }
    }

    function createSlider($images){
        foreach($images as $img_num=>$img_url) {
            if ($img_url != "") {
                if ($img_num == "1") {
                    echo '<div class="item active" data-slide-number="' . $img_num . '">
                    <img src="' . $img_url . '"></div>';
                } else {
                    echo '<div class="item" data-slide-number="' . $img_num . '">
                    <img src="' . $img_url . '"></div>';
                }
            }
        }
    }

    ?>




</head>

<body class="full">
<?php if($me == 3) {include("includes/navbarAdmin.html");}
else {include("includes/navbar.php");}?>

<!--Main page content-->
<div class="container">

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <br><br><br>
                <hr>
                <h2 class="intro-text text-center">Image Gallery</h2>
                <hr>
                <hr class="visible-xs">
                <br>

                <?php if($me == 1) { ?>
                    <div class="btn-group galleryButtons" >
                    <button type = "button" class="btn btn-primary" data-toggle = "modal" data-target = "#myModal" > Upload Image </button >
                    <button type = "button" class="btn btn-primary" data-toggle = "popover"  data-content = "Select image from thumbnails below to delete." > Delete Image </button >
                    <button type = "button" class="btn btn-primary" data-toggle = "popover"  data-content = "Select image from thumbnails below to update profile image" > Update Profile Picture </button >
                </div >
                <?php }?>


                <?php if($me == 3){ ?>
                    <div class = "admin_notice">
                        <p><h4>Admin notice:</h4><br>Review user images for offensive material<br> If offensive image found, select image and delete</p>
                    </div>
                <?php } ?>




                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

<!--                         Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Upload Images</h4>
                            </div>
                            <div class="modal-body">
                                <p>
                                    <?php
                                    if(ImageService::checkIfImageGalleryFull($images)) { ?>
                                        <br> Unfortunately your image gallery is full.
                                        You can have a maximum of 16 images. Please delete an image to make room for new uploads.
                                    <?php
                                    } else {
                                    ?>

                                <form method="POST" action="uploadImage.php" enctype="multipart/form-data">
                                    <input type="hidden" name="uid" value="<?php echo $uid?>">
                                    <input type="hidden" name="me" value="<?php echo $me?>">
                                    <input type="hidden" name="form_submitted" value="yes">

                                    <input type="file" name="myimage" id="myimage" ">
                                    <br><br><button type="submit" name="submit_image" value="submit_image" class="btn btn-primary" >Upload Image</button>
                                </form>

                                <?php } ?>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>


                <br><br><br>

                <?php
                $images = ImageService::getImages($uid);
                ?>


                <div id="main_area">
                    <!-- Slider -->
                    <div class="row">
                        <div class="col-sm-6" id="slider-thumbs">
                            <!-- Bottom switcher of slider -->
                            <ul class="hide-bullets">
                                <form method="post" action="viewImagePage.php">
                                    <input type="hidden" name="uid" value="<?php echo $uid?>">
                                    <input type="hidden" name="me" value="<?php echo $me?>">
                                    <?php
                                    createThumbnails($images);
                                    ?>
                                </form>
                            </ul>

                            <br><br><br><br><br><br>
                            <br><br><br><br><br><br>
                            <br><br><br><br><br><br>
                            <br><br><br>


                            <form action="profilePage.php?<?php if($me==3){echo 'admin=true&';}?>uid=<?php echo $uid; ?>" method="post">
                                <input type="hidden" name="uid" value="<?php echo $uid?>">
                                <input type="hidden" name="me" value="<?php echo $me?>">
                                <button type="submit" name="goBack" class="btn btn-info buttons_left" >Back to Profile Page <span class="glyphicon glyphicon-user"></span></button>
                            </form>

                        </div>
                        <div class="col-sm-6">
                            <div class="col-xs-12" id="slider">
                                <!-- Top part of the slider -->
                                <div class="row">
                                    <div class="col-sm-12" id="carousel-bounding-box">
                                        <div class="carousel slide" id="myCarousel">
                                            <!-- Carousel items -->
                                            <div class="carousel-inner">

                                                <?php
                                                createSlider($images);
                                                ?>
                                            </div>
                                            <!-- Carousel nav -->
                                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left"></span>
                                            </a>
                                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br><br><br><br><br>



                    </div>
                </div>
                <br><br><br><br>
            </div>
        </div>
    </div>

</div>

<?php include("includes/footer.html"); ?>

<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>

</body>

</html>