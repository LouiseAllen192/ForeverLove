<?php


class UserPrefrences{

    private $userID, $tagLine, $city, $gender, $seeking, $intent, $dateob;
    private $heigth, $ethnicity, $bodyType, $religion, $maritalStatus, $income;
    private $hasChildren, $wantsChildren, $smoker, $drinker, $aboutMe;

    public function __construct($uid){
        $this->userID = $uid;
        setPreferences(DB::getInstance()->get('preference_details', ['User_id', '=', $uid])->results()[0]);
    }

    private function setPreferences($preferences){
        $this->tagLine = $preferences->Tag_Line;
        $this->city = $preferences->City;
        $this->gender = $preferences->Gender;
        $this->seeking = $preferences->Seeking;
        $this->intent = $preferences->Intent;
        $this->dateob = $preferences->Date_Of_Birth;
        $this->heigth = $preferences->Height;
        $this->ethnicity = $preferences->Ethnicity;
        $this->bodyType = $preferences->Body_Type;
        $this->religion = $preferences->Religion;
        $this->maritalStatus = $preferences->Marital_Status;
        $this->income = $preferences->Income;
        $this->hasChildren = $preferences->Has_Children;
        $this->wantsChildren = $preferences->Wants_Children;
        $this->smoker = $preferences->Smoker;
        $this->drinker = $preferences->Drinker;
        $this->aboutMe = $preferences->About_Me;
    }


    public function getUserID()
    {
        return $this->userID;
    }


    public function getTagLine()
    {
        return $this->tagLine;
    }


    public function getCity()
    {
        return $this->city;
    }


    public function getGender()
    {
        return $this->gender;
    }


    public function getSeeking()
    {
        return $this->seeking;
    }


    public function getIntent()
    {
        return $this->intent;
    }


    public function getDateob()
    {
        return $this->dateob;
    }


    public function getHeigth()
    {
        return $this->heigth;
    }

    public function getEthnicity()
    {
        return $this->ethnicity;
    }


    public function getBodyType()
    {
        return $this->bodyType;
    }


    public function getReligion()
    {
        return $this->religion;
    }


    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }


    public function getIncome()
    {
        return $this->income;
    }


    public function getHasChildren()
    {
        return $this->hasChildren;
    }

    public function getWantsChildren()
    {
        return $this->wantsChildren;
    }

    public function getSmoker()
    {
        return $this->smoker;
    }

    public function getDrinker()
    {
        return $this->drinker;
    }

    public function getAboutMe()
    {
        return $this->aboutMe;
    }
}

?>
