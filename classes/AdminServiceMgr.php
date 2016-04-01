<?php
class AdminServiceMgr{

    public static function addReport($reportee, $source = []){
        $reporter = $_SESSION['user_id'];
        $db = DB::getInstance();
        $cid = 0;
        if($source['view_conversation']){
            $sql = "SELECT conversation_id FROM conversations WHERE ((user1_id = '$reporter' && user2_id = '$reportee') || (user1_id = '$reporter' && user2_id = '$reportee'))";
            if($db->query($sql)->count()){
                $cid = $db->results()[0]->conversation_id;
            }
        }
        $db->insert(
            'banned_reports',
            [
                'reporter_id' => $reporter,
                'reportee_id' => $reportee,
                'conversation_id' => $cid,
                'priority' => $source['priority'],
                'content' => $source['content'],
                'view_conversation' => $source['view_conversation']
            ]
        );
    }

    public static function banUser($uid, $report_id, $ban_length){
        $n = 0;
        switch($ban_length){
            case 1: $n = 7; break;
            case 2: $n = 14; break;
            case 3: $n = 30; break;
            case 4: $n = 60; break;
            case 5: $n = 120; break;
        }
        $permanent = ($n != 0) ? 0 : 1;

        return DB::getInstance()->insert(
            'banned_users',
            [
                'user_id' => $uid,
                'report_id' => $report_id,
                'end_date' => (new DateTime())->add(new DateInterval('P'.$n.'D'))->format('Y-m-d H:i:s'),
                'permanent' => $permanent
            ]
        );
    }
}