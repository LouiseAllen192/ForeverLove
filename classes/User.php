<?php

class User{

    private $userID;
    private $userName;
    private $firstName;
    private $lastName;
    private $password;
    private $email;
    private $accDetails; // UserAcountDetails Object
    private $prefrences; // UserPrefrences Object
    private $userHobbies; // UserHobbies Object


    public function __construct($uid, $accDet, $uPref, $uHob){
        $this->userID = $uid;
        $this->accDetails = $accDet;
        $this->prefrences = $uPref;
        $this->userHobbies = $uHob;
        setUserDetails(DB::getInstance()->get('registration_details', ['User_id', '=', $uid])->results()[0]);
    }

    private function setUserDetails($details){
        $this->userName = $details->Username;
        $this->firstName = $details->First_Name;
        $this->lastName = $details->ULast_Name;
        $this->password = $details->Password;
        $this->email = $details->Email;
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
        return $this->prefrences;
    }

}

?>