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