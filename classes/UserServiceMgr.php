<?php

class UserServiceMgr
{

    private $userID;

    public function __construct($uid){
        $this->userID = $uid;
    }


    public static function login($userid){
        //todo
    }

    public static function logout($userid){
        //todo
    }

    public static function updateAccountDetails($changes, $userID){
        // $changes - should be in format ['username' => 'Kevin', 'name' => 'Kevin O\'Brien']
        $success = DB::getInstance()->update('account_details', $userID, $changes);
        return $success;
    }

    public static function updateBasicUserDetails($userid, $changes){

        $keys = array("Username","First_Name", "Last_Name", "Password" , "Email");

        for($i=0; $i<count($keys); $i++){
            if($changes[$keys[$i]]== '' || $changes[$keys[$i]]== 'Apply Changes'){
                unset($changes[$keys[$i]]);
            }

        }
        $success = DB::getInstance()->update('registration_details', $userid, $changes);
        return $success;

    }

    public static function updateUserHobbies($userid, $postArray){
        $changes = array();

        $keys = array('Reading','Cinema','Shopping','Socializing','Travelling',
            'Walking','Exercise','Soccer','Dancing', 'Horses','Running','Eating_Out',
            'Painting', 'Cooking', 'Computers', 'Bowling', 'Writing', 'Skiing', 'Crafts',
            'Golf', 'Chess', 'Gymnastics','Cycling','Swimming','Surfing','Hiking','Video_Games',
            'Volleyball','Badminton','Gym','Parkour','Fashion','Yoga','Basketball','Boxing', 'Unique_Hobbie');

        for($i=0; $i<count($keys) ; $i++){
            if(!isset ($postArray[$keys[$i]])) {
                $changes[$keys[$i]] = "0";
            } else {
                $changes[$keys[$i]] = "1";
            }
        }

        if(isset ($postArray['Unique_Hobbie'])){ $changes['Unique_Hobbie'] = $postArray['Unique_Hobbie'];}
        if($changes['Unique_Hobbie']== ''){ unset($changes['Unique_Hobbie']);}

        $success = DB::getInstance()->update('hobbies', $userid, $changes);
        return $success;

    }

    public static function updateUserPreferences($userid, $changes){

        $keys = array("Tag_Line", "City", "Gender", "Seeking", "Intent",
            "Height", "Ethnicity","Body_Type","Religion", "Marital_Status","Income",
            "Has_Children", "Wants_Children","Smoker", "Drinker", "About__Me");
        for($i=0; $i<count($keys); $i++){
            if ($changes[$keys[$i]] == '' || $changes[$keys[$i]] == 'Apply Changes') {
                unset($changes[$keys[$i]]);
            }
        }
        $success = DB::getInstance()->update('preference_details', $userid, $changes);
        if($success) return true;
        else return false;
    }

    public static function updateImageGallery($userid){
        //todo
    }

    public static function reportUser($reporterUserid, $abuserUserid){
        //todo
    }

    public static function upgradeAccountType($userid){
        //todo
    }

    public static function upgradeMembership($userid){
        //todo
    }

    public static function register($userid){
        //todo
    }

    public static function registerPreferences($userid, $changes){
        if($changes['Tag_Line']== ''){
            $changes['Tag_Line'] = 'Unselected';
        }
        if($changes['City']== ''){
            $changes['City'] = 'Unselected';
        }

        if($changes['Send']== 'Apply Changes'){
            unset($changes['Send']);
        }
        $success = DB::getInstance()->update('preference_details', $userid, $changes);
        if($success) return true;
        else return false;
    }

    public static function registerHobbies($postArray, $userid){
        $changes = array();
        $keys = array('Reading','Cinema','Shopping','Socializing','Travelling',
            'Walking','Exercise','Soccer','Dancing', 'Horses','Running','Eating_Out',
            'Painting', 'Cooking', 'Computers', 'Bowling', 'Writing', 'Skiing', 'Crafts',
            'Golf', 'Chess', 'Gymnastics','Cycling','Swimming','Surfing','Hiking','Video_Games',
            'Volleyball','Badminton','Gym','Parkour','Fashion','Yoga','Basketball','Boxing', 'Unique_Hobbie');

        for($i=0; $i<count($keys) ; $i++){
            if(!isset ($postArray[$keys[$i]])) {
                $changes[$keys[$i]] = "0";
            } else {
                $changes[$keys[$i]] = "1";
            }
        }

        if(isset ($postArray['Unique_Hobbie'])){ $changes['Unique_Hobbie'] = $postArray['Unique_Hobbie'];}
        if($changes['Unique_Hobbie']== ''){ unset($changes['Unique_Hobbie']);}

        if($_GET['Send']== 'Apply Changes'){
            unset($postArray['Send']);
        }
        $success = DB::getInstance()->update('hobbies', $userid, $changes);
        if($success) return true;
        else return false;
    }
}