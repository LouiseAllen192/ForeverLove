<?php
class SearchServiceMgr{

    public static function byCriteria($list, $preferences){
        $sql = "SELECT d.user_id,d.username,d.tag_line,d.city,Total FROM (SELECT c.user_id,c.username,c.tag_line,c.city,";
        $n = 1;
        $last = count($preferences);
        foreach($preferences as $preference => $value){
            if($n++ == $last){
                $sql .= "(CASE WHEN c.$preference IS NOT NULL && c.$preference = $value THEN c.Total + 1 ELSE c.Total END)AS Total";
            }
            else{
                $sql .= "(CASE WHEN c.$preference IS NOT NULL && c.$preference = $value THEN 1 ELSE 0 END)+";
            }
        }
        if(!$last) $sql .= "Total";
        $sql .= " FROM (SELECT b.*,";
        $n = 1;
        $last = count($list);
        foreach($list as $item){
            $sql .= "COALESCE(b.$item, 0)";
            if($n++ < $last){
                $sql .= "+";
            }
        }
        if(!$last) $sql .= "0";
        $sql .= " AS Total FROM (SELECT a.user_id,a.username,a.tag_line,a.city";
        $n = 1;
        $last = count($preferences);
        foreach($preferences as $preference => $value){
            if($n++ <= $last){
                $sql .= ",";
            }
            $sql .= 'a.'.$preference;
        }
        $n = 1;
        $last = count($list);
        foreach($list as $item){
            if($n++ <= $last){
                $sql .= ",";
            }
            $sql .= "MAX(CASE WHEN a.hobby_id = '$item' THEN a.hobby_preference END)AS '$item'";
        }
        $n = 1;
        $last = count($preferences);
        $requiredPreferences = '';
        foreach($preferences as $preference => $value){
            if($n++ <= $last){
                $requiredPreferences .= ',';
            }
            $requiredPreferences .= $preference;
        }
        $sql .= " FROM (SELECT user_id,username,tag_line,city,hobby_id,hobby_preference$requiredPreferences";
        $sql .= " FROM registration_details JOIN preference_details USING(user_id)";
        $sql .= " JOIN user_hobby_preferences USING(user_id))a GROUP BY user_id)b )c ORDER BY Total DESC)d WHERE Total > 0";
        return DB::getInstance()->query($sql)->results();
    }
}