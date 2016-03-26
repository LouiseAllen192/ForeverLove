<?php

$uid = 2;
$imgNum = 1;

$file = $_FILES['myimage']['tmp_name'];
$file_name = $_FILES['myimage']['name'];
$size = $_FILES["myimage"]["size"];
$target_dir = "userImageUploads/user".$uid."/";
$name = basename($file_name);
$target_file = $target_dir . basename($file_name);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if image file is an actual image or fake image
if(isset($_POST["submit_image"])) {
    $check = getimagesize($file);
    if($check !== false) {
        echo "File is an image - ".$check["mime"].".";
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
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
                        echo "The file ".$name." has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    }
    else {
        echo "File is not an image.";
    }
}
else{
    echo 'submit_image not set';
}

?>