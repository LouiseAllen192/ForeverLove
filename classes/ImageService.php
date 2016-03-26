<?php

class ImageService
{

    public static function getImages($uid){
        //todo
    }

    public static function updateProfileImage(){
        //todo
    }

    public static function changeImage(){
        //todo
    }

    public static function deleteImage($imgNum){
        return true;
        //todo
    }

    public static function uploadImage(){
        //todo
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