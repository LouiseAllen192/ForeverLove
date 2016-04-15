<?php

class UserServiceMgr
{

    private $userID;

    public function __construct($uid){
        $this->userID = $uid;
    }

    public static function login($source){
        $errors = [];
        if(isset($source['username']) && $source['username'] != ''){
            $username = $source['username'];
            if(($result = DB::getInstance()->query("SELECT user_id, password FROM registration_details WHERE username = '$username'")->results()[0])) {
                if(! (UserServiceMgr::userAccountExpired($username))) {
                    if (!(UserServiceMgr::userIsBanned($username))) {
                        if (isset($source['password']) && $source['password'] != '') {
                            if (password_verify($source['password'], $result->password)) {
                                $_SESSION['permissions'] = 'user';
                                $_SESSION['user_id'] = $result->user_id;
                                header('Location: homePage.php');
                                die();
                            }
                            else { $errors['password'] = 'error_login';}

                        } else { $errors['password'] = 'error_required';}
                    }
                    else { $errors['username'] = 'error_banned';}
                }
                else { $errors['expired'] = 'error_expired';}
            }
            else{ $errors['username'] = 'error_login';}
        }
        else{ $errors['username'] = 'error_required';}
        return $errors;
    }

    public static function userIsBanned($username){
       $uid = ReturnShortcuts::getUserID($username);
       $resultBanned = DB::getInstance()->query("SELECT user_id FROM banned_users")->results();
       foreach($resultBanned as $result){
           if($uid == $result->user_id){
               return true;
           }
       }
       return false;
    }

    public static function userAccountExpired($username){
        $uid = ReturnShortcuts::getUserID($username);
        $result = DB::getInstance()->query("SELECT account_expired FROM account_details WHERE user_id = '$uid'")->results()[0];
        $expired = $result->account_expired;
        if( strtotime($expired) < strtotime('now') ) {
            return true;
        }
        return false;
    }

    public static function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['permissions']);
//        session_destroy($_SESSION['user_id']);
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

        if($uniqueSuccess && $prefSuccess){
            return true;
        }
        else{
            return false;
        }

    }


    public static function updateUserPreferences($userid, $changes, $regOrUpdate){
        $keys = array("tag_line", "city", "gender", "seeking", "intent",
            "height", "ethnicity","body_type","religion", "marital_status","income",
            "has_children", "wants_children","smoker", "drinker", "about_me", "Send");

        for($i=0; $i<count($keys); $i++){
            if($regOrUpdate == "Register"){
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

    //takes in name of a preference table and the choice as a string
    //returns the choice_id that goes with the choice selected
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


    public static function registerUpgradeAccountType($uid, $accLength){
        $date = new DateTime();
        $changes = array();
        if($accLength == 30) {
            $changes['account_type']= "Free";
            $date->add(new DateInterval('P'.$accLength.'D'));
            $changes['account_expired']= $date->format('Y-m-d');
        }
        else                {
            $changes['account_type']= "Premium";
            $date->add(new DateInterval('P'.$accLength.'M'));
            $changes['account_expired']= $date->format('Y-m-d');
        }
        $where = "user_id = '".$uid."'";

        $success = DB::getInstance()->update('account_details', $where, $changes);
        return $success;
    }


    public static function validateCreditCard($post){
        $values = array (
        'fullname' => $post['fullname'],
        'ccNumber' => $post['ccNumber'],
        'month' => $post['month'],
        'year' => $post['year'],
        'security' => $post['security'] );

        $ch = curl_init("http://amnesia.csisdmz.ul.ie/4014/cc.php?".http_build_query($values));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result; //1 for accept, 0 for fail

    }


    public static function getUsername($uid){
        $sql = "SELECT username " .
            "FROM registration_details ".
            "WHERE user_id = '".$uid."'";
        return DB::getInstance()->query($sql)->results()[0]->username;
    }

    public static function getUniqueHobby($uid){
        $sql = "SELECT unique_hobby " .
            "FROM unique_hobby ".
            "WHERE user_id = '".$uid."'";
        return DB::getInstance()->query($sql)->results()[0]->unique_hobby;
    }

    public static function validateCreditCardDetails($source){
        $validate = new Validate(); //value= POST['fullname']
        $validate->check(
            $source,
            [      //item => rules
                'fullname' => [

                   //rule=> rulevalue
                    'required' => true,
                    'matches' => '/^[a-z ,.\'-]+$/i'
                ],
                'ccNumber' => [
                    'required' => true,
                    'matches' => '/^\d{16}$/'
                ],
                'month' => [
                    'required' => true,
                    'matches' => '/^\d{2}$/'
                ],
                'year' => [
                    'required' => true,
                    'matches' => '/^\d{2}$/'
                ],
                'security' => [
                    'required' => true,
                    'matches' => '/^\d{3}$/'
                ]
            ]);

        if($validate->passed()){
            return false;
        }
        else{ return $validate->getErrors();}
    }


    public static function registerUpdateAccount($source, $update = false){
        $validate = new Validate();
        $validate->check(
            $source,
            [
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
                ],
                'dob' => [
                    'required' => true,
                    'over_18' => true
            ]
        ]);

        if($validate->passed()){
            $fields = [
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email']
            ];

            if($update){
                DB::getInstance()->update('registration_details', 'user_id = '.$_SESSION['user_id'], $fields);
                DB::getInstance()->update('preference_details', 'user_id = '.$_SESSION['user_id'], ['date_of_birth' => $_POST['dob']]);
            }
            else{
                DB::getInstance()->registerUser('registration_details', $fields, $_POST['dob']);
            }
//            if(!isset($_SESSION['user_id'])) {
                $_SESSION['user_id'] = DB::getInstance()->get('registration_details', ['username', '=', $_POST['username']])->results()[0]->user_id;
                $_SESSION['permissions'] = 'user';
//            }
            return false;
        }
        else{ return $validate->getErrors();}
    }

    public static function getPreferencesValidationErrors($source, $update){
       $required = true;
        if($update){
            $required=false;
        }
        $validate = new Validate();
        $validate->check(
            $source,
            [
                'tag_line' => [
                    'required' => $required,
                    'matches' => '/^[a-zA-Z.\\- ,\']{2,256}$/',
                ],
                'city' => [
                    'required' => $required,
                    'matches' => '/^[a-zA-Z ]{2,32}$/'
                ],
                'about_me' => [
                    'required' => $required,
                    'matches' => '/^[a-zA-Z0-9 \\-,.\']{2,256}$/',
                ]
            ]);

        if($validate->passed()){
            return false;
        }
        else{ return $validate->getErrors();}
    }

    public static function getHobbiesValidationErrors($source, $update){
        $required = true;
        if($update){
            $required=false;
        }
        $validate = new Validate();
        $validate->check(
            $source,
            [
                'unique_hobby' => [
                    'required' => $required,
                    'matches' => '/^[a-zA-Z ]{2,256}$/',
                ]
            ]);

        if($validate->passed()){
            return false;
        }
        else{ return $validate->getErrors();}
    }

    public static function updatePassword($source){
        $validate = new Validate();
        $validate->check(
            $source,
            [
                'old_password' => [
                    'required' => true,
                    'matches' => '/^[a-zA-Z0-9_-]{6,32}$/'
                ],
                'old_password_confirm' => [
                    'required' => true,
                    'matches' => '/\b('.$_POST['old_password'].')\b/'
                ],
                'new_password' => [
                    'required' => true,
                    'matches' => '/^[a-zA-Z0-9_-]{6,32}$/'
                ],
                'new_password_confirm' => [
                    'required' => true,
                    'matches' => '/\b('.$_POST['new_password'].')\b/'
                ]
            ]);

        if($validate->passed()){
            $fields = [
                'password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT)
            ];

            DB::getInstance()->update('registration_details', 'user_id = '.$_SESSION['user_id'], $fields);

            return false;
        }
        else{ return $validate->getErrors();}
    }

    public static function getEmailErrors($source){
        $validate = new Validate();
        $validate->check(
            $source,
            [
                'email' => [
                    'required' => true,
                ]
            ]);
        if($validate->passed()){
            return false;
        }
        else{ return $validate->getErrors();}
    }

    public static function checkIfEmailExists($email){
        $sql = "SELECT email " .
            "FROM registration_details  ";

        $results = DB::getInstance()->query($sql)->results();
        foreach ($results as $result) {
            if(strcmp($result->email, $email) == 0){
                return true;
            }
        }
        return false;
    }

    public static function getUserIdFromEmail($email){
        $sql = "SELECT user_id " .
            "FROM registration_details ".
            "WHERE email = '".$email."'";
        return DB::getInstance()->query($sql)->results()[0]->user_id;
    }

    public static function validateReport($source){
        $validate = new Validate();
        $validate->check(
            $source,
            [
                'priority' => [
                    'required' => true
                ],
                'content' => [
                    'required' => true,
                    'matches' => '/^[a-zA-Z 0-9.,!?\\/]/'
                ]
            ]
        );
        if(!$validate->passed()){
            return $validate->getErrors();
        }
    }

    public static function determineUpdateOrReg($uid){

        $sql = "SELECT unique_hobby ".
            "FROM unique_hobby  ".
            "WHERE user_id = '".$uid."'";
        $results = DB::getInstance()->query($sql)->results();
        foreach($results as $result) {
            if ($result->unique_hobby == null) {
                $updOrReg = "Register";
            } else {
                $updOrReg = "Update";
            }
        }
       return $updOrReg;
    }


}