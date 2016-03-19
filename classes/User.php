<?php

class User{

    private $userID;
    private $userName;
    private $firstName;
    private $lastName;
    private $password;
    private $email;
    private $accDetails;
    private $preferences;
    private $userHobbies;


    public function __construct($uid){
        $this->userID = $uid;

        $details = DB::getInstance()->get('registration_details', ['User_id', '=', $uid])->results()[0];
        $accdet = DB::getInstance()->get('account_details', ['User_id', '=', $uid])->results()[0];
        $pref = DB::getInstance()->get('preference_details', ['User_id', '=', $uid])->results()[0];

        $this->setDet($details);
        $this->setPref($pref, $uid);
        $this->setHob($uid);
        $this->setAcc($accdet, $uid);

    }

    public function setDet($details){
        $this->userName = $details->username;
        $this->firstName = $details->first_name;
        $this->lastName = $details->last_name;
        $this->password = $details->password;
        $this->email = $details->email;
        $this->accDetails = array();
        $this->preferences = array();
        $this->userHobbies = array();
    }

    public function setPref($preferences, $uid){
        $this->preferences['userid'] = $uid;
        $this->preferences['tag_line'] = $preferences->tag_line;
        $this->preferences['city'] = $preferences->city;
        $this->preferences['about_me'] = $preferences->about_me;
        $this->preferences['date_of_birth'] = $preferences->date_of_birth;

        $dbvalue = array("gender"=>$preferences->gender,"seeking"=>$preferences->seeking, "intent"=>$preferences->intent,
            "height"=>$preferences->height, "ethnicity"=>$preferences->ethnicity,"body_type"=>$preferences->body_type,
             "religion"=>$preferences->religion, "marital_status"=>$preferences->marital_status,"income"=>$preferences->income,
            "has_children"=>$preferences->has_children, "wants_children"=>$preferences->wants_children,
            "smoker"=>$preferences->smoker, "drinker"=>$preferences->drinker);

        foreach($dbvalue as $key=>$value){
            $pref = DB::getInstance()->get($key, ['id', '=', $value])->results()[0];
            $this->preferences[$key] = $pref->option;
        }
    }

    public function setHob($uid){
        $this->userHobbies['userid'] = $uid;

        for($i=1; $i < 36; $i++) {
            $sql = "SELECT hobby_name, hobby_preference " .
                "FROM user_hobbies JOIN user_hobby_preferences USING(hobby_id) " .
                "WHERE user_id = '".$uid."' && hobby_id = '".$i."'";

            $results = DB::getInstance()->query($sql)->results();
            foreach ($results as $result) {
                $this->userHobbies[$result->hobby_name] = $result->hobby_preference;
            }
        }
    }

    public function setAcc($accDet, $uid){
        $this->accDetails['userid'] = $uid;
        $this->accDetails['account_type'] = $accDet->account_type;
        $this->accDetails['free_trail_used'] = $accDet->free_trail_used;
        $this->accDetails['account_expired'] = $accDet->account_expired;
    }



    public function getUserId(){
        return $this->userID;
    }

    public function getUsername(){
        return $this->userName;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getAccDetails(){
        return $this->accDetails;
    }

    public function getUserPrefrences(){
        return $this->preferences;
    }

    public function getHobbies(){
        return $this->userHobbies;
    }

}

?>