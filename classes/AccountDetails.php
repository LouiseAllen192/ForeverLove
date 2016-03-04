<?php


class AccountDetails{

    private $userID;
    private $premium;
    private $freeTrialUsed;
    private $accExpiry;
    private $pCode;

    public function __construct($uid, $prem, $freetriu, $exp, $pcd){
        $this->userID = $uid;
        $this->premium = $prem;
        $this->freeTrialUsed = $freetriu;
        $this->accExpiry = $exp;
        $this->pCode = $pcd;
    }

    public function getUserID(){
        return $this->userID;
    }

    public function getPremium(){
        return $this->premium;
    }

    public function getFreeTrialUsed(){
        return $this->freeTrialUsed;
    }

    public function getAccExpiry(){
        return $this->accExpiry;
    }

    public function getPCode(){
        return $this->pCode;
    }
}

?>