<?php
class BannedUser{
    private $user_id,$report_id,$start_date,$end_date;

    public function __construct($u_id){
        $this->user_id = $u_id;
        $this->report_id = 7; // just temp for testing as db not working for me
        $this->start_date = "2016/03/23"; //just temp for testing as db not working for me
        $this->end_date = "2016/04/27"; //just temp for testing as db not working for me
       // BannedUsers(DB::getInstance()->get('banned_users', ['user_id', '=', $u_id])->results()[0]);
    }

    private function BannedUsers($Information){
        $this->report_id = $Information->Report_id;
        $this->start_date = $Information->Start_date;
        $this->end_date = $Information->End_date;
    }
    public function getUserId(){
        return $this->user_id;
    }

    public function getReportId(){
        return $this->report_id;
    }

    public function getStartDate(){
        return $this->start_date;
    }

    public function getEndDate(){
        return $this->end_date;
    }

}