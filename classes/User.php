<?php

class User{

    private $userID;
    private $userName;
    private $firstName;
    private $lastName;
    private $password;
    private $email;
    private $accDetails;
    private $prefrences;
    private $userHobbies;


    public function __construct($uid, $uname, $fname, $lname, $passw, $em, $accDet, $pref, $hobb){
        $this->userID = $uid;
        $this->userName = $uname;
        $this->firstName = $fname;
        $this->lastName = $lname;
        $this->password = $passw;
        $this->email = $em;
        $this->accDetails = $accDet;
        $this->prefrences = $pref;
        $this->userHobbies = $hobb;
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