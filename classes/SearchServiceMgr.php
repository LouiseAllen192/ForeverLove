<?php
class SearchServiceMgr{

    public static function byCriteria($hobbies, $preferences){
        $sql = "SELECT d.user_id,d.username,d.tag_line,d.city,TIMESTAMPDIFF(YEAR, d.date_of_birth, CURDATE()) AS age,Total";
        $sql .= " FROM (SELECT c.user_id,c.username,c.tag_line,c.city,c.date_of_birth,";
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
        $last = count($hobbies);
        foreach($hobbies as $hobby){
            $sql .= "COALESCE(b.$hobby, 0)";
            if($n++ < $last){
                $sql .= "+";
            }
        }
        if(!$last) $sql .= "0";
        $sql .= " AS Total FROM (SELECT a.user_id,a.username,a.tag_line,a.city,a.date_of_birth";
        $n = 1;
        $last = count($preferences);
        foreach($preferences as $preference => $value){
            if($n++ <= $last){
                $sql .= ",";
            }
            $sql .= 'a.'.$preference;
        }
        $n = 1;
        $last = count($hobbies);
        foreach($hobbies as $hobby){
            if($n++ <= $last){
                $sql .= ",";
            }
            $sql .= "MAX(CASE WHEN a.hobby_id = '$hobby' THEN a.hobby_preference END)AS '$hobby'";
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
        $sql .= " FROM (SELECT user_id,username,tag_line,city,date_of_birth,hobby_id,hobby_preference$requiredPreferences";
        $sql .= " FROM registration_details JOIN preference_details USING(user_id)";
        $sql .= " JOIN user_hobby_preferences USING(user_id))a GROUP BY user_id)b )c ORDER BY Total DESC)d WHERE Total > 0";
        return DB::getInstance()->query($sql)->results();
    }

    public static function matchAge($age, $results){
        $finalResults = [];
        foreach($results as $result){
            switch($age){
                case 18:
                    if($result->age < 25) $finalResults[] = $result;
                    break;
                case 25:
                    if($result->age > 24 && $result->age < 35) $finalResults[] = $result;
                    break;
                case 35:
                    if($result->age > 34 && $result->age < 45) $finalResults[] = $result;
                    break;
                case 45:
                    if($result->age > 44 && $result->age < 55) $finalResults[] = $result;
                    break;
                case 55:
                    if($result->age > 54) $finalResults[] = $result;
                    break;
            }
        }
        return $finalResults;
    }
}