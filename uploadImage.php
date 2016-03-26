<?php
require_once 'core/init.php';
include("includes/metatags.html");
include($_SERVER['DOCUMENT_ROOT'] . '/classes/User.php');
include($_SERVER['DOCUMENT_ROOT'] . '/classes/ImageService.php');
include($_SERVER['DOCUMENT_ROOT'] . '/classes/DB.php');
include("includes/navbar.html");


$imgNum = ImageService::returnFirstEmptySlotNumber($images);

$file = $_FILES['myimage']['tmp_name'];
$file_name = $_FILES['myimage']['name'];
$size = $_FILES["myimage"]["size"];
$target_dir = "userImageUploads/user".$uid."/";
$name = basename($file_name);
$target_file = $target_dir . basename($file_name);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$infoMsg ="";

// Check if image file is an actual image or fake image
if(isset($_POST["submit_image"])) {
    $check = getimagesize($file);
    if($check !== false) {
        if (file_exists($target_file)) {
            echo "Sorry, an image with that filename already exists for this user. Please upload an image with a unique filename";
        }
        else{
            if ($size > 500000) {
                echo "Sorry, your file is too large.";
            }
            else{
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                }
                else{
                    if (move_uploaded_file($file, $target_file)) {
                        if(ImageService::uploadImage($uid, $imgNum, $target_file, $name)){
                            echo "The file ".$name." has been uploaded.";
                        }
                        else{
                            echo 'Image not stored in db correctly';
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    }
    else { echo "Error - File is not an image."; }
}
else{ echo 'submit_image not set';}

?>