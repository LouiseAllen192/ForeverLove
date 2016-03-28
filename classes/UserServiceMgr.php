<?php

class UserServiceMgr
{

    private $userID;

    public function __construct($uid){
        $this->userID = $uid;
    }


    public static function login($source){
        if(isset($source['username'])){
            $errors = [];
            $username = $source['username'];
            if(($result = DB::getInstance()->query("SELECT user_id, password FROM registration_details WHERE username = '$username'")->results()[0])) {
                if(isset($source['password'])){
                    if(password_verify($source['password'], $result->password)){
                        $_SESSION['user_id'] = $result->user_id;
                        header('Location: homePage.php');
                        die();
                    }
                    else{ $errors['password'] = 'error_login';}
                }
                else{ $errors['password'] = 'error_required';}
            }
            else{ $errors['username'] = 'error_login';}
        }
        else{ $errors['username'] = 'error_required';}
        return $errors;
    }

    public static function logout(){
        unset($_SESSION['user_id']);
    }


    public static function updateBasicUserDetails($uid, $source){

        if(isset($source['Send'])) unset($source['Send']);

        $requiredConfEmail = false;
        if(isset($source['email'])) $requiredConfEmail = true;
        $requiredConfPass = false;
        if(isset($source['password'])) $requiredConfPass= true;

        $validate = new Validate();
        $validate->check($source, [
            'email' => [
                'matches' => '/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/',
                'unique' => 'registration_details'
            ],
            'confirm_email' => [
                'required' => $requiredConfEmail,
                'matches' => '/\b('.$_POST['email'].')\b/'
            ],
            'username' => [
                'matches' => '/^[a-zA-Z0-9_-]{3,32}$/',
                'unique' => 'registration_details'
            ],
            'first_name' => [
                'matches' => '/^[a-zA-Z]{2,32}$/'
            ],
            'last_name' => [
                'matches' => '/^[a-zA-Z\'-]{2,32}$/'
            ],
            'password' => [
                'matches' => '/^[a-zA-Z0-9_-]{6,32}$/',
            ],
            'confirm_password' => [
                'required' => $requiredConfPass,
                'matches' => '/\b('.$_POST['password'].')\b/'
            ]
        ]);

        if($validate->passed()){
            DB::getInstance()->update('registration_details', "user_id = '".$uid."'", $source);
            return false;
        }
        else{
            return $validate->getErrors();
        }
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

    public static function updateImageGallery($userid){
        //todo
    }

    public static function reportUser($reporterUserid, $abuserUserid){
        //todo
    }

    public static function registerAccountType($uid, $accLength){
        $date = new DateTime();
        $changes = array();
        if($accLength == 30) {
            $changes['account_type']= "Free";
            $changes['free_trail_used']= 1;
            $date->add(new DateInterval('P'.$accLength.'D'));
            $changes['account_expired']= $date->format('Y-m-d');
        }
        else                {
            $changes['account_type']= "Premium";
            $changes['free_trail_used']= 0;
            $date->add(new DateInterval('P'.$accLength.'M'));
            $changes['account_expired']= $date->format('Y-m-d');
        }
        $where = "user_id = '".$uid."'";

        $success = DB::getInstance()->update('account_details', $where, $changes);
        return $success;
    }




    public static function validateCreditCard($userid){
        //todo
        return true;
    }

    public static function upgradeMembership($userid){
        //todo
    }

    public static function getUsername($uid){
        $sql = "SELECT username " .
            "FROM registration_details  ".
            "WHERE user_id = '".$uid."'";
        $results = DB::getInstance()->query($sql)->results()[0];
        $username = $results->username;
        return $username;
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
                'first_name' => $_POST['first_name'], 'last_name' => $_POST['last_name'],
                'email' => $_POST['email']
            ];

            if($update){
                DB::getInstance()->update('registration_details', 'user_id = '.$_SESSION['user_id'], $fields);
                DB::getInstance()->update('preference_details', 'user_id = '.$_SESSION['user_id'], ['date_of_birth' => $_POST['dob']]);
            }
            else{
                DB::getInstance()->registerUser('registration_details', $fields, $_POST['dob']);
            }
            if(!isset($_SESSION['user_id'])) {
                $_SESSION['user_id'] = DB::getInstance()->get('registration_details', ['username', '=', $_POST['username']])->results()[0]->user_id;
            }
            return false;
        }
        else{ return $validate->getErrors();}
    }

    public static function validateReport($source){
        $validate = new Validate();
        $validate->check(
            $source,
            [
                'priority' => [
                    'required' => true,
                ],
                'content' => [
                    'required' => true,
                    'matches' => '/^[a-zA-Z 0-9.,!?\\/]/'
                ]
            ]
        );

        if($validate->passed()){
            echo 'passed';
        }
        else{ return $validate->getErrors();}
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

    public static function errorsExistInCardDetails(){
        $validate = new Validate();
        $validate->check($_POST, [
            'name_on_card' => [
                'required' => true,
                'matches' => '/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/',
            ],
            'cardnum' => [
                'required' => true,
                'matches' => '/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/',
            ],
            'expiry' => [
                'required' => true,
                'matches' => '/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/',
            ],
            'cvv' => [
                'required' => true,
                'matches' => '/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/',
            ],
            'address' => [
                'required' => true,
                'matches' => '/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/',
            ]
        ]);

        if($validate->passed()){
            return false;
        }
        else{
            return $validate->getErrors();
        }
    }

}