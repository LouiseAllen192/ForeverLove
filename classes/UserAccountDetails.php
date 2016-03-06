<?php


class AccountDetails{

    private $userID;
    private $premium;
    private $freeTrialUsed;
    private $accExpiry;
    private $pCode;

    public function __construct($uid){
        $this->userID = $uid;
        setAccDetails(DB::getInstance()->get('account_details', ['User_id', '=', $uid])->results()[0]);
    }

    private function setAccDetails($accDetails){
        $this->premium = $accDetails->Premium;
        $this->freeTrialUsed = $accDetails->Free_Trail_Used;
        $this->accExpiry = $accDetails->Account_Expiry;
        $this->pCode = $accDetails->P_Code;
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