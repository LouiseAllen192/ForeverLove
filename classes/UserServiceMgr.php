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

    //TODO - not working/finished. Need to FIX!!!!!!!!!!!!!!!
    public static function updateUserHobbies($userid, $postArray, $regOrUpdate){
        $changes = array();

        $keys = array('Reading','Cinema','Shopping','Socializing','Travelling',
            'Walking','Exercise','Soccer','Dancing', 'Horses','Running','Eating_Out',
            'Painting', 'Cooking', 'Computers', 'Bowling', 'Writing', 'Skiing', 'Crafts',
            'Golf', 'Chess', 'Gymnastics','Cycling','Swimming','Surfing','Hiking','Video_Games',
            'Volleyball','Badminton','Gym','Parkour','Fashion','Yoga','Basketball','Boxing');

        for($i=0; $i<count($keys) ; $i++){
            if(!isset ($postArray[$keys[$i]])) {
                $changes[$keys[$i]] = "0";
            } else {
                $changes[$keys[$i]] = "1";
            }
        }

        $unique = array();
        if(isset ($postArray['unique_hobbie'])){
            $unique['unique_hobbie'] = $postArray['unique_hobbie'];
        }
        if($unique['unique_hobbie']== ''){
            unset($unique['unique_hobbie']);
        }

        $prefSuccess = DB::getInstance()->update('hobbies', $userid, $changes);
        $uniqueSuccess = DB::getInstance()->update('hobbies', $userid, $changes);
        if($prefSuccess && $uniqueSuccess){
            $success=true;
        }
        else{
            $success=false;
        }
        return $success;

    }

    public static function updateUserPreferences($userid, $changes, $regOrUpdate){
        $keys = array("tag_line", "city", "gender", "seeking", "intent",
            "height", "ethnicity","body_type","religion", "marital_status","income",
            "has_children", "wants_children","smoker", "drinker", "about_me");


        for($i=0; $i<count($keys); $i++){
            if($regOrUpdate == "registration"){
                if(!isset($changes[$keys[$i]])){
                    return false;
                }
                if ($changes[$keys[$i]] == 'Register Changes') {
                    unset($changes[$keys[$i]]);
                }
            }
            else{
                if(!isset($changes[$keys[$i]]) || $changes[$keys[$i]] == 'Update Changes'){
                    unset($changes[$keys[$i]]);
                }
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

    public static function register(){
        $validate = new Validate();
        $validate->check($_POST, [
            'email' => [
                'required' => true,
                'matches' => '/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/',
                'unique' => 'registration_details'
            ],
            'confirm_email' => [
                'required' => true,
                'matches' => '/\b('.$_POST['email'].')\b/'
            ],
            'username' => [
                'required' => true,
                'matches' => '/^[a-zA-Z0-9_-]{3,32}$/',
                'unique' => 'registration_details'
            ],
            'first_name' => [
                'required' => true,
                'matches' => '/^[a-zA-Z]{2,32}$/'
            ],
            'last_name' => [
                'required' => true,
                'matches' => '/^[a-zA-Z\'-]{2,32}$/'
            ],
            'password' => [
                'required' => true,
                'matches' => '/^[a-zA-Z0-9_-]{6,32}$/',
            ],
            'confirm_password' => [
                'required' => true,
                'matches' => '/\b('.$_POST['password'].')\b/'
            ]
        ]);

        if($validate->passed()){
            DB::getInstance()->registerUser('registration_details', ['username' => $_POST['username'], 'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), 'first_name' => $_POST['first_name'], 'last_name' => $_POST['last_name'], 'email' => $_POST['email']]);
            $_SESSION['user_id'] = DB::getInstance()->get('registration_details', ['username', '=', $_POST['username']])->results()[0]->user_id;
            return false;
        }
        else{
            return $validate->getErrors();
        }
    }

}