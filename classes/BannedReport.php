<?php
class BannedReport{
    private $report_id, $reporter_id, $reportee_id, $content, $resolved;

    public function __construct($report_id, $reporter_id, $reportee_id, $content, $resolved){
        $this->report_id = $report_id;
        $this->reporter_id = $reporter_id;
        $this->reportee_id = $reportee_id;
        $this->content = $content;
        $this->resolved = $resolved;
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