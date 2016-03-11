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
        // $changes - should be in format ['username' => 'Kevin', 'name' => 'Kevin O\'Brien']
        $success = DB::getInstance()->update('registration_details', $userid, $changes);
        if($success){
            echo "<div class=\"alert alert-success\">
                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        User Details updated successfully
                  </div>";
        }
        else{
            echo "<div class=\"alert alert-danger\">
                       <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        <strong>Error</strong> - User Details update was unsuccessful
                   </div>";
        }
    }

    public static function updateUserHobbies($userid, $changes){
        // $changes - should be in format ['username' => 'Kevin', 'name' => 'Kevin O\'Brien']
        $success = DB::getInstance()->update('hobbies', $userid, $changes);
        if($success){

            echo "<div class=\"alert alert-success\">
                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        User Hobbies updated successfully
                  </div>";
        }
        else{
            echo "<div class=\"alert alert-danger\">
                       <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        <strong>Error</strong> - User Hobbies update was unsuccessful
                   </div>";
        }
    }

    public static function updatePrefrences($userid, $changes){
        // $changes - should be in format ['username' => 'Kevin', 'name' => 'Kevin O\'Brien']
        $success = DB::getInstance()->update('preference_details', $userid, $changes);
        if($success){

            echo "<div class=\"alert alert-success\">
                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        User Prefrences Details updated successfully
                  </div>";
        }
        else{
            echo "<div class=\"alert alert-danger\">
                       <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        <strong>Error</strong> - User Prefrences Details update was unsuccessful
                   </div>";
        }
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

    //to be removed later
    public static function testFunction($changes){
        return true;

    }



}