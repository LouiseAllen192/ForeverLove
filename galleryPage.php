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

    //hardcoded array of image urls - to be changed to urls from database
    $images = array("0"=>"http://zblogged.com/wp-content/uploads/2015/11/17.jpg", "1"=> "http://www.jeffbullas.com/wp-content/uploads/2013/10/the-10-most-annoying-types-of-people-on-facebook.jpg", "2"=> "http://templates.elearningbrothers.com/files/2011/01/athletic_people_images.png", "3"=> "http://blogs-images.forbes.com/travisbradberry/files/2014/10/Toxic_people1.jpg",
        "4"=> "http://all4desktop.com/data_images/original/4240423-people.jpg", "5"=> "https://c1.staticflickr.com/3/2823/9501964248_a388be25a8.jpg", "6"=> "http://img2.timeinc.net/people/i/2012/news/120806/emily-maynard-2-320.jpg",
        "7"=> "http://img2-2.timeinc.net/people/i/2015/red-carpet/grammys/backstage-lessons/taylor-swift-2-320.jpg", "8"=> "https://c2.staticflickr.com/8/7151/6424464061_de9d36f647_b.jpg", "9"=> "http://img2-2.timeinc.net/people/i/2015/red-carpet/grammys/backstage-lessons/taylor-swift-2-320.jpg",
        "10"=> "http://templates.elearningbrothers.com/files/2011/01/athletic_people_images.png", "11"=> "http://www.dogoilpress.com/data/wallpapers/6/FDS_377793.jpg", "12"=> "http://all4desktop.com/data_images/original/4240423-people.jpg",
        "13"=> "", "14"=> "http://templates.elearningbrothers.com/files/2011/01/athletic_people_images.png",
        "15"=> "http://cdn.playbuzz.com/cdn/2c9b6d1a-61df-4c7a-8d46-6824b5603684/f31e88ef-97df-419d-9414-b1a662266c8e.jpg",
    );

    $selectedImage="";

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
                if ($img_num == "0") {
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
<?php include("includes/navbar.html"); ?>

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



                <div class="btn-group galleryButtons">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Upload Image</button>
                    <button type="button" class="btn btn-primary" data-toggle="popover"  data-content="Select image from thumbnails below to delete.">Delete Image</button>
                    <button type="button" class="btn btn-primary" data-toggle="popover"  data-content="Select image from thumbnails below to update profile image">Update Profile Picture</button>
                </div>

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
                                    <?php if(ImageService::checkIfImageGalleryFull($images)) { ?>
                                        <br> Unfortunately your image gallery is full.
                                        You can have a maximum of 16 images. Please delete an image to make room for new uploads.
                                    <?php } else {?>
                                        Empty slot at: <?php echo ImageService::returnFirstEmptySlotNumber($images)?>
                                        //insert upload image functionality here
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
                <div id="main_area">
                    <!-- Slider -->
                    <div class="row">
                        <div class="col-sm-6" id="slider-thumbs">
                            <!-- Bottom switcher of slider -->
                            <ul class="hide-bullets">
                                <form method="post" action="viewImagePage.php">
                                    <?php
                                        createThumbnails($images);
                                    ?>
                                </form>
                            </ul>
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