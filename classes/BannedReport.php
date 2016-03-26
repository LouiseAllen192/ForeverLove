<?php
class BannedReport{
    private $report_id, $reporter_id, $reportee_id, $content, $resolved;

    public function __construct($report_id){
        $this->report_id = $report_id;
        setParams(DB::getInstance()->get('banned_reports', ['report_id', '=', $report_id])->results()[0]);
    }



    private function setParams($params){
        $this->reporter_id = $params->Reporter_id;
        $this->reportee_id = $params->Reportee_id;
        $this->content = $params->Content;
        $this->resolved = $params->Resolved;
    }

    public function getReportId(){
        return $this->report_id;
    }

    public function getReporterId(){
        return $this->reporter_id;
    }

    public function getReporteeId(){
        return $this->reportee_id;
    }

    public function getContent(){
        return $this->content;
    }

    public function getResolved(){
        return $this->resolved;
    }
}