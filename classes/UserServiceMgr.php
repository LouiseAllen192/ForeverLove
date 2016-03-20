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

    public static function updateAccountDetails($changes, $uid){
      //todo
    }

    public static function updateBasicUserDetails($uid, $changes){
        $keys = array("username","first_name", "last_name", "password" , "email", "Send");
        for($i=0; $i<count($keys); $i++){
            if($changes[$keys[$i]]== '' || $changes[$keys[$i]]== 'Apply Changes'){
                unset($changes[$keys[$i]]);
            }

        }
        $where = "user_id = '".$uid."'";
        $success = DB::getInstance()->update('registration_details', $where, $changes);
        return $success;

    }


    public static function updateUserHobbies($uid, $postArray){
        $update = array();
        $prefSuccess = true;
        $uniqueSuccess = true;

        $unique = array();
        if(isset($postArray['unique_hobby'])){
            $unique['unique_hobby'] = $postArray['unique_hobby'];
            if($unique['unique_hobby'] == ''){
                $uniqueSuccess = true;
            }
            else{
                $uniqueWhere = "user_id = '".$uid."'";
                $uniqueSuccess = DB::getInstance()->update('unique_hobby', $uniqueWhere ,  $unique);
            }
        }


        $keys = ReturnShortcuts::returnHobbyNames();
        for($i=1; $i<=count($keys) && $prefSuccess; $i++){
            $where = "user_id = '".$uid."' AND hobby_id = '".$i."'";
            if(!isset ($postArray[$keys[$i]])) {
                $update['hobby_preference'] = "0";
            } else {
                $update['hobby_preference'] = "1";
            }
            $prefSuccess = DB::getInstance()->update('user_hobby_preferences', $where , $update);
        }

        //$prefSuccess &&

        if($uniqueSuccess){
            return true;
        }
        else{
            return false;
        }

    }

    //TODO: about_me still not sending
    public static function updateUserPreferences($userid, $changes, $regOrUpdate){
        $keys = array("tag_line", "city", "gender", "seeking", "intent",
            "height", "ethnicity","body_type","religion", "marital_status","income",
            "has_children", "wants_children","smoker", "drinker", "about_me", "Send");

        echo '<'.'br><br><br><br><br><br>';

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
                if(!isset($changes[$keys[$i]]) || $changes[$keys[$i]] == '' || $changes[$keys[$i]] == 'Update Changes'){
                    unset($changes[$keys[$i]]);
                }
            }
        }

        foreach($changes as $key=>$value){
            if($key != 'tag_line' && $key != 'city' && $key != 'about_me'){
                $changes[$key] = UserServiceMgr::returnChoiceNumber($key, $value);
            }
        }

        $where = "user_id = '".$userid."'";
        $success = DB::getInstance()->update('preference_details', $where, $changes);
        if($success) return true;
        else return false;
    }

    public static function returnChoiceNumber($name, $choiceSelected){
        $sql = "SELECT * " .
            "FROM ".$name." ";

        $results = DB::getInstance()->query($sql)->results();
        foreach ($results as $result) {
            if($choiceSelected == $result->choice){
                return $result->id;
            }
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