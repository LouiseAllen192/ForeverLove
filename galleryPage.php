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
    $images = array("0"=>"http://placehold.it/150x150&text=zero", "1"=> "http://placehold.it/150x150&text=1", "2"=> "http://placehold.it/150x150&text=2", "3"=> "http://placehold.it/150x150&text=3",
        "4"=> "http://placehold.it/150x150&text=4", "5"=> "http://placehold.it/150x150&text=5", "6"=> "http://placehold.it/150x150&text=6",
        "7"=> "http://placehold.it/150x150&text=7", "8"=> "http://placehold.it/150x150&text=8", "9"=> "http://placehold.it/150x150&text=9",
        "10"=> "http://placehold.it/150x150&text=10", "11"=> "http://placehold.it/150x150&text=11", "12"=> "http://placehold.it/150x150&text=12",
        "13"=> "http://placehold.it/150x150&text=13", "14"=> "http://placehold.it/150x150&text=14", "15"=> "http://placehold.it/150x150&text=15",
        "16"=> "http://all4desktop.com/data_images/original/4240423-people.jpg");

    function createThumbnail($img_num, $img_url){
        echo '<'.'li class="col-sm-3">
                <a class="thumbnail" id="carousel-selector-'.$img_num.'"><img src="'.$img_url.'"></a>
               </li>';
    }

    function createSlider($img_num, $img_url){
        echo '<div class="item" data-slide-number="'.$img_num.'">
        <img src="'.$img_url.'"></div>';
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

                <br><br><br>
                <div id="main_area">
                    <!-- Slider -->
                    <div class="row">
                        <div class="col-sm-6" id="slider-thumbs">
                            <!-- Bottom switcher of slider -->
                            <ul class="hide-bullets">
                                <?php
                                foreach($images as $img_num=>$imgUrl){
                                    createThumbnail($img_num, $imgUrl);
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-xs-12" id="slider">
                                <!-- Top part of the slider -->
                                <div class="row">
                                    <div class="col-sm-12" id="carousel-bounding-box">
                                        <div class="carousel slide" id="myGalleryCarousel">
                                            <!-- Carousel items -->
                                            <div class="carousel-inner">

                                                <div class="active item" data-slide-number="0">
                                                    <img src="http://placehold.it/470x480&text=zero"></div>

                                                <?php
                                                for($i=1; $i<count($images); $i++){
                                                    createSlider($i, $images[$i]);
                                                }
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
</body>

</html>