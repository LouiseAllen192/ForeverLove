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


    $me;
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

    echo '<br><br><br><br><br><br><br><br>';
    var_dump($_POST);
    echo '<br><br>';
    var_dump($_FILES);

    if(empty($_FILES)){echo '<br>EMPTY FILES ARRAY!';}

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
<?php include("includes/navbar.php"); ?>

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

                <?php if($me) { ?>
                    <div class="btn-group galleryButtons" >
                    <button type = "button" class="btn btn-primary" data-toggle = "modal" data-target = "#myModal" > Upload Image </button >
                    <button type = "button" class="btn btn-primary" data-toggle = "popover"  data-content = "Select image from thumbnails below to delete." > Delete Image </button >
                    <button type = "button" class="btn btn-primary" data-toggle = "popover"  data-content = "Select image from thumbnails below to update profile image" > Update Profile Picture </button >
                </div >
                <?php }?>

                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
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

                                <form method="POST" action="galleryPage.php" enctype="multipart/form-data">
                                    <input type="hidden" name="uid" value="<?php echo $uid?>">
                                    <input type="hidden" name="me" value="<?php echo $me?>">
                                    <input type="hidden" name="form_submitted" value="yes">

                                    <input type="file" name="myimage" id="myimage" ">
                                    <br><br><button type="submit" name="submit_image" value="submit_image" class="btn btn-primary" >Upload Image</button>
                                </form>

                                <?php if(isset($_POST['form_submitted'])){

                                    $error = $_FILES['myimage']['error'];
                                    $infoMsgType = "danger";

                                    if($error == 0) {
                                        $imgNum = ImageService::returnFirstEmptySlotNumber($images);
                                        $file = $_FILES['myimage']['tmp_name'];
                                        $file_name = $_FILES['myimage']['name'];
                                        $size = $_FILES["myimage"]["size"];
                                        $target_dir = "userImageUploads/user" . $uid . "/";
                                        $name = basename($file_name);
                                        $target_file = $target_dir . basename($file_name);
                                        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                                        $infoMsg = "UNSET";


                                        // Check if image file is an actual image or fake image
                                        $check = getimagesize($file);
                                        if ($check !== false) {
                                            if (file_exists($target_file)) {
                                                $infoMsg = "Sorry, an image with that filename already exists for this user. Please upload an image with a unique filename";
                                            } else {
                                                if ($size > 500000) {
                                                    $infoMsg = "Sorry, your file is too large.";
                                                } else {
                                                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                                        $infoMsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                                    } else {
                                                        if (move_uploaded_file($file, $target_file)) {
                                                            if (ImageService::uploadImage($uid, $imgNum, $target_file, $name)) {
                                                                $infoMsg = "The file " . $name . " has been uploaded.";
                                                                $infoMsgType = "success";
                                                            } else {
                                                                $infoMsg = 'Image not stored in db correctly';
                                                            }
                                                        } else {
                                                            $infoMsg = "Sorry, there was an error uploading your file.";
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            $infoMsg = "Error - File is not an image.";
                                        }
                                    }
                                    else{
                                        if($error == 1){$infoMsg = "The uploaded file exceeds the upload_max_filesize directive in php.ini.";}
                                        if($error == 2){$infoMsg = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";}
                                        if($error == 3){$infoMsg = "The uploaded file was only partially uploaded.";}
                                        if($error == 4){$infoMsg = "No file was uploaded.";}
                                        if($error == 5){$infoMsg = "Missing a temporary folder";}
                                        if($error == 6){$infoMsg = "Failed to write file to disk";}
                                        if($error == 7){$infoMsg = "A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.";}
                                    }
                                 ?>

                                <?php }}?>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>


                <br><br><br>

                <?php if(isset($_POST['form_submitted'])){ ?>
                <div class= "alert alert-<?php echo $infoMsgType;?>" role="alert">
                    <a href="galleryPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $infoMsg;?>
                </div>
                <?php }
                $images = ImageService::getImages($uid);
                unset($_FILES);
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


                            <form action="profilePage.php" method="post">
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