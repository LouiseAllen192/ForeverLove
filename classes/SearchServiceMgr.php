<?php
class SearchServiceMgr{

    public static function byCriteria($list, $preferences){
        $sql = "SELECT a.user_id,a.username,a.tag_line,a.city,Total FROM (SELECT z.user_id,z.username,z.tag_line,z.city";
        $n = 1;
        $last = count($preferences);
        foreach($preferences as $preference => $value){
            if($n <= $last){
                $sql .= ",";
            }
            if($n == $last){
                $sql .= "(CASE WHEN z.$preference IS NOT NULL && z.$preference = $value THEN z.Total + 1 ELSE z.Total END)AS Total";
            }
            else{
                $sql .= "(CASE WHEN z.$preference IS NOT NULL && z.$preference = $value THEN 1 ELSE 0 END)+";
            }
        }
        if(!$last) $sql .= ",Total";
        $sql .= " FROM (SELECT y.*,";
        $n = 1;
        $last = count($list);
        foreach($list as $item){
            $sql .= "COALESCE(y.$item, 0)";
            if($n++ < $last){
                $sql .= "+";
            }
        }
        if(!$last) $sql .= "0";
        $sql .= " AS Total FROM (SELECT x.user_id,x.username,x.tag_line,x.city";
        $n = 1;
        $last = count($preferences);
        $requiredPreferences = '';
        foreach($preferences as $preference => $value){
            if($n++ <= $last){
                $sql .= ",";
            }
            $requiredPreferences .= 'x.'.$preference;
        }
        $sql .= $requiredPreferences;
        $n = 1;
        $last = count($list);
        foreach($list as $item){
            if($n++ <= $last){
                $sql .= ",";
            }
            $sql .= "MAX(CASE WHEN x.hobby_id = '$item' THEN x.hobby_preference END)AS '$item'";
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
        $sql .= " JOIN user_hobby_preferences USING(user_id))x GROUP BY user_id)y )z ORDER BY Total DESC)a WHERE Total > 0";
        return DB::getInstance()->query($sql)->results();
    }
}