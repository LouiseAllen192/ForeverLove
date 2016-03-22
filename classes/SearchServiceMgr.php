<?php
class SearchServiceMgr{

    public static function byCriteria($list){
        $last = count($list);
        $n = 1;
        $sql = "SELECT z.* FROM (SELECT y.*,";
        foreach($list as $item){
            $sql .= "COALESCE(y.$item, 0)";
            if($n++ < $last){
                $sql .= "+";
            }
        }
        $sql .= " AS Total FROM (SELECT x.user_id,x.username,x.tag_line,x.city,";
        $n = 1;
        foreach($list as $item){
            $sql .= "MAX(CASE WHEN x.hobby_id = '$item' THEN x.hobby_preference END)AS '$item'";
            if($n++ < $last){
                $sql .= ",";
            }
        }
        $sql .= " FROM (SELECT user_id,username,tag_line,city,hobby_id,hobby_preference FROM registration_details JOIN preference_details USING(user_id)";
        $sql .= " JOIN user_hobby_preferences USING(user_id))x GROUP BY user_id)y ORDER BY Total DESC)z WHERE Total > 0";
        return DB::getInstance()->query($sql)->results();
    }
}