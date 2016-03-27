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

    public static function updateProfileImage($imageNum, $uid){
        //todo
        return true;
    }


    public static function deleteImage($imgNum, $uid){
        $sql = "SELECT image_name " .
            "FROM images  ".
            "WHERE user_id = '".$uid."' AND image_id = '".$imgNum."'\";" ;
        $results = DB::getInstance()->query($sql)->results()[0];

        foreach ($results as $result) {
           $imgName = $result->image_name;
        }

//        $path = "userImageUploads/user".$uid."/".$imgName;
//        unlink($path);

//        $update = array("image_path" => "", "image_name" => "");
//        $where = "user_id = '".$uid."' AND image_id = '".$imgNum."'";
//        if(DB::getInstance()->update('images', $where , $update)){
//            return true;
//        }
        //return false;

        return true;
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