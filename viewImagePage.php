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

    //hardcoded array of image urls - to be changed to urls from database
    $images = array("0"=>"http://zblogged.com/wp-content/uploads/2015/11/17.jpg", "1"=> "http://www.jeffbullas.com/wp-content/uploads/2013/10/the-10-most-annoying-types-of-people-on-facebook.jpg", "2"=> "http://templates.elearningbrothers.com/files/2011/01/athletic_people_images.png", "3"=> "http://blogs-images.forbes.com/travisbradberry/files/2014/10/Toxic_people1.jpg",
        "4"=> "http://all4desktop.com/data_images/original/4240423-people.jpg", "5"=> "https://c1.staticflickr.com/3/2823/9501964248_a388be25a8.jpg", "6"=> "http://img2.timeinc.net/people/i/2012/news/120806/emily-maynard-2-320.jpg",
        "7"=> "http://img2-2.timeinc.net/people/i/2015/red-carpet/grammys/backstage-lessons/taylor-swift-2-320.jpg", "8"=> "https://c2.staticflickr.com/8/7151/6424464061_de9d36f647_b.jpg", "9"=> "http://img2-2.timeinc.net/people/i/2015/red-carpet/grammys/backstage-lessons/taylor-swift-2-320.jpg",
        "10"=> "http://templates.elearningbrothers.com/files/2011/01/athletic_people_images.png", "11"=> "http://www.dogoilpress.com/data/wallpapers/6/FDS_377793.jpg", "12"=> "http://all4desktop.com/data_images/original/4240423-people.jpg",
        "13"=> "http://www.parapolitika.gr/sites/default/files/parapolitikaold/mediadefaultimagespareja.jpg", "14"=> "http://templates.elearningbrothers.com/files/2011/01/athletic_people_images.png",
        "15"=> "http://cdn.playbuzz.com/cdn/2c9b6d1a-61df-4c7a-8d46-6824b5603684/f31e88ef-97df-419d-9414-b1a662266c8e.jpg",
    );

    function endsWith($word, $x) {
        return $x === "" || (($temp = strlen($word) - strlen($x)) >= 0 && strpos($word, $x, $temp) !== false);
    }



    $imageNum;
        foreach($_POST as $key=>$value){
            if(endsWith($key, '_x')){
                $imageNum = (string)$key;
                $imageNum = str_replace('_x', '', $imageNum);
            }
            if($value == "Change" || $value == "Delete" || $value == "ProfilePic"){
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
                    <button type="submit" name="<?php echo $imageNum?>"  class="btn btn-primary" Value="Change">Change Image</button>
                    <button type="submit" name="<?php echo $imageNum?>" class="btn btn-primary" Value="Delete" >Delete Image</button>
                </div>
                    <div class="btn-group myButtonsRight">
                        <button type="submit" name="<?php echo $imageNum?>"  class="btn btn-primary" Value="ProfilePic" >Set as Profile Picture</button>
                    </div>
                </form>

                <?php
                if(isset($_POST[$imageNum])) {
                    if ($_POST[$imageNum] == "Change") {
                        echo 'Insert change image functionality here';
                    }
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
                        ?><br><br><br><br>
                        <div class= "alert alert-<?php echo $alertType?>" role="alert">
                            <a href="galleryPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $alertMsg?>
                        </div>
                   <?php }
                    if ($_POST[$imageNum] == "ProfilePic") {

                    }
                }
                ?>


                <br><br><br><br>
                <?php
                if(isset($_POST[$imageNum])) {
                    if ($_POST[$imageNum] != "Delete") {
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