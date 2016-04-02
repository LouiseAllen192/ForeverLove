<?php

class ImageService
{

    public static function getImages($uid){
        $resultFinal = array();
        $sql = "SELECT * " .
            "FROM images  ".
            "WHERE user_id = '".$uid."'";

        $results = DB::getInstance()->query($sql)->results();
        foreach ($results as $result) {
            $resultFinal[$result->image_id] = $result->image_path;
        }
        return $resultFinal;
    }

    public static function updateProfileImage($imgNum, $uid){
        $sql1 = "SELECT * " .
            "FROM images  ".
            "WHERE user_id = '".$uid."' AND image_id = '".$imgNum."'";
        $newResults = DB::getInstance()->query($sql1)->results()[0];
        $newProfileName = $newResults->image_name;
        $newProfilePath  = $newResults->image_path;

        $sql2 = "SELECT * " .
            "FROM images  ".
            "WHERE user_id = '".$uid."' AND image_id = 1";
        $oldResults = DB::getInstance()->query($sql2)->results()[0];
        $oldProfileName = $oldResults->image_name;
        $oldProfilePath  = $oldResults->image_path;

        $changesProfile = array("image_path" => "$newProfilePath", "image_name" => "$newProfileName");
        $whereProfile = "user_id = '".$uid."' AND image_id = 1";
        $successProfile = DB::getInstance()->update('images', $whereProfile , $changesProfile);


        $changesOther = array("image_path" => "$oldProfilePath", "image_name" => "$oldProfileName");
        $whereOther =  "user_id = '".$uid."' AND image_id = '".$imgNum."'";
        $successOther = DB::getInstance()->update('images', $whereOther , $changesOther);


        if($successProfile && $successOther){
            return true;
        }
        return false;

    }


    public static function deleteImage($imgNum, $uid){
        $sql = "SELECT image_name " .
            "FROM images  ".
            "WHERE user_id = '".$uid."' AND image_id = '".$imgNum."'";
        $results = DB::getInstance()->query($sql)->results()[0];
        $imgName = $results->image_name;

        $path = "userImageUploads/user".$uid."/".$imgName;
        unlink($path);

        $update = array("image_path" => "", "image_name" => "");
        $where = "user_id = '".$uid."' AND image_id = '".$imgNum."'";
        if(DB::getInstance()->update('images', $where , $update)){
            return true;
        }
        return false;
    }

    public static function uploadImage($uid, $imgNum, $path, $name){
        $update = array("image_path" => "$path", "image_name" => "$name");
        $where = "user_id = '".$uid."' AND image_id = '".$imgNum."'";
        if(DB::getInstance()->update('images', $where , $update)){
            return true;
        }
        return false;
    }

    public static function uploadFileImage($source, $uid, $images){
        $infoMsgInfo = array();
        $infoMsgInfo['type'] = "danger";
        $infoMsgInfo['msg'] = "UNSET";
        $error = $source['myimage']['error'];

        if($error == 0) {
            $imgNum = ImageService::returnFirstEmptySlotNumber($images);
            $file = $source['myimage']['tmp_name'];
            $file_name = $source['myimage']['name'];
            $size = $source["myimage"]["size"];
            $target_dir = "userImageUploads/user" . $uid . "/";
            $name = basename($file_name);
            $target_file = $target_dir . basename($file_name);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


            // Check if image file is an actual image or fake image
            $check = getimagesize($file);
            if ($check !== false) {
                if (file_exists($target_file)) {
                    $infoMsgInfo['msg'] = "Sorry, an image with that filename already exists for this user. Please upload an image with a unique filename";
                } else {
                    if ($size > 500000) {
                        $infoMsgInfo['msg'] = "Sorry, your file is too large.";
                    } else {
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                            $infoMsgInfo['msg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        } else {
                            if (move_uploaded_file($file, $target_file)) {
                                if (ImageService::uploadImage($uid, $imgNum, $target_file, $name)) {
                                    $infoMsgInfo['msg'] = "The file " . $name . " has been uploaded.";
                                    $infoMsgInfo['type'] = "success";
                                } else {
                                    $infoMsgInfo['msg'] = 'Image not stored in db correctly';
                                }
                            } else {
                                $infoMsgInfo['msg'] = "Sorry, there was an error uploading your file.";
                            }
                        }
                    }
                }
            } else {
                $infoMsgInfo['msg'] = "Error - File is not an image.";
            }
        }

        else{
        if($error == 1){$infoMsgInfo['msg'] = "The uploaded file exceeds the upload_max_filesize directive in php.ini.";}
        if($error == 2){$infoMsgInfo['msg'] = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";}
        if($error == 3){$infoMsgInfo['msg'] = "The uploaded file was only partially uploaded.";}
        if($error == 4){$infoMsgInfo['msg'] = "No file was uploaded.";}
        if($error == 5){$infoMsgInfo['msg'] = "Missing a temporary folder";}
        if($error == 6){$infoMsgInfo['msg'] = "Failed to write file to disk";}
        if($error == 7){$infoMsgInfo['msg'] = "A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.";}
        }
        return $infoMsgInfo;
    }



    public static function checkIfImageGalleryFull($images){
        foreach($images as $key=>$value){
            if($value == ''){
                return false;
                break;
            }
        }
        return true;
    }

    public static function returnFirstEmptySlotNumber($images){
        foreach($images as $key=>$value){
            if($value == ''){
                return $key;
                break;
            }
        }
    }


}