<?php


class UserPrefrences{

    private $userID;
    private $tagLine;
    private $city;
    private $gender;
    private $seeking;
    private $intent;
    private $dateob;
    private $heigth;
    private $ethnicity;
    private $bodyType;
    private $religion;
    private $maritalStatus;
    private $income;
    private $hasChildren;
    private $wantsChildren;
    private $smoker;
    private $drinker;
    private $aboutMe;


    public function __construct($uid, $tLine, $cy, $gen, $seek, $i, $dob, $ht, $eth,
                                $btype, $rel, $mstat, $inc, $hChil, $wChil, $smk, $drk, $abMe)
    {
        $this->userID = $uid;
        $this->tagLine = $tLine;
        $this->city = $cy;
        $this->gender = $gen;
        $this->seeking = $seek;
        $this->intent = $i;
        $this->dateob = $dob;
        $this->heigth = $ht;
        $this->ethnicity = $eth;
        $this->bodyType = $btype;
        $this->religion = $rel;
        $this->maritalStatus = $mstat;
        $this->income = $inc;
        $this->hasChildren = $hChil;
        $this->wantsChildren = $wChil;
        $this->smoker = $smk;
        $this->drinker = $drk;
        $this->aboutMe = $abMe;
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
