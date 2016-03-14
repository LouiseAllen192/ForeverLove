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
        $hob = DB::getInstance()->get('hobbies', ['User_id', '=', $uid])->results()[0];

        $this->setDet($details);
        $this->setPref($pref, $uid);
        $this->setHob($hob, $uid);
        $this->setAcc($accdet, $uid);

    }

    public function setDet($details){
        $this->userName = $details->Username;
        $this->firstName = $details->First_Name;
        $this->lastName = $details->Last_Name;
        $this->password = $details->Password;
        $this->email = $details->Email;
        $this->accDetails = array();
        $this->preferences = array();
        $this->userHobbies = array();
    }

    public function setPref($preferences, $uid){
        $this->preferences['Userid'] = $uid;
        $this->preferences['Tag_Line'] = $preferences->Tag_Line;
        $this->preferences['City'] = $preferences->City;
        $this->preferences['Gender'] = $preferences->Gender;
        $this->preferences['Seeking'] = $preferences->Seeking;
        $this->preferences['Intent'] = $preferences->Intent;
        $this->preferences['Date_Of_Birth'] = $preferences->Date_Of_Birth;
        $this->preferences['Height'] = $preferences->Height;
        $this->preferences['Ethnicity'] = $preferences->Ethnicity;
        $this->preferences['Body_Type'] = $preferences->Body_Type;
        $this->preferences['Religion'] = $preferences->Religion;
        $this->preferences['Marital_Status'] = $preferences->Marital_Status;
        $this->preferences['Income'] = $preferences->Income;
        $this->preferences['Has_Children'] = $preferences->Has_Children;
        $this->preferences['Wants_Children'] = $preferences->Wants_Children;
        $this->preferences['Smoker'] = $preferences->Smoker;
        $this->preferences['Drinker'] = $preferences->Drinker;
        $this->preferences['AboutMe'] = $preferences->About_Me;
    }

    public function setHob($hobbies, $uid){
        $this->userHobbies['Userid'] = $uid;
        $this->userHobbies['Reading'] = $hobbies->Reading;
        $this->userHobbies['Cinema'] = $hobbies->Cinema;
        $this->userHobbies['Shopping'] = $hobbies->Shopping;
        $this->userHobbies['Socializing'] = $hobbies->Socializing;
        $this->userHobbies['Travelling'] = $hobbies->Travelling;
        $this->userHobbies['Walking'] = $hobbies->Walking;
        $this->userHobbies['Exercise'] = $hobbies->Exercise;
        $this->userHobbies['Soccer'] = $hobbies->Soccer;
        $this->userHobbies['Dancing'] = $hobbies->Dancing;
        $this->userHobbies['Horses'] = $hobbies->Horses;
        $this->userHobbies['Running'] = $hobbies->Running;
        $this->userHobbies['Eating_Out'] = $hobbies->Eating_Out;
        $this->userHobbies['Painting'] = $hobbies->Painting;
        $this->userHobbies['Cooking'] = $hobbies->Cooking;
        $this->userHobbies['Computers'] = $hobbies->Computers;
        $this->userHobbies['Bowling'] = $hobbies->Bowling;
        $this->userHobbies['Writing'] = $hobbies->Writing;
        $this->userHobbies['Skiing'] = $hobbies->Skiing;
        $this->userHobbies['Crafts'] = $hobbies->Crafts;
        $this->userHobbies['Golf'] = $hobbies->Golf;
        $this->userHobbies['Chess'] = $hobbies->Chess;
        $this->userHobbies['Gymnastics'] = $hobbies->Gymnastics;
        $this->userHobbies['Cycling'] = $hobbies->Cycling;
        $this->userHobbies['Swimming'] = $hobbies->Swimming;
        $this->userHobbies['Surfing'] = $hobbies->Surfing;
        $this->userHobbies['Hiking'] = $hobbies->Hiking;
        $this->userHobbies['Video_Games'] = $hobbies->Video_Games;
        $this->userHobbies['Volleyball'] = $hobbies->Volleyball;
        $this->userHobbies['Badminton'] = $hobbies->Badminton;
        $this->userHobbies['Gym'] = $hobbies->Gym;
        $this->userHobbies['Parkour'] = $hobbies->Parkour;
        $this->userHobbies['Fashion'] = $hobbies->Fashion;
        $this->userHobbies['Yoga'] = $hobbies->Yoga;
        $this->userHobbies['Basketball'] = $hobbies->Basketball;
        $this->userHobbies['Boxing'] = $hobbies->Boxing;
        $this->userHobbies['Unique_Hobbie'] = $hobbies->Unique_Hobbie;
    }

    public function setAcc($accDet, $uid){
        $this->accDetails['Userid'] = $uid;
        $this->accDetails['Account_Type'] = $accDet->Account_Type;
        $this->accDetails['Free_Trail_Used'] = $accDet->Free_Trail_Used;
        $this->accDetails['Account_Expiry'] = $accDet->Account_Expiry;
        $this->accDetails['P_Code'] = $accDet->P_Code;
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