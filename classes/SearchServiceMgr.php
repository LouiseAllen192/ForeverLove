<?php
class SearchServiceMgr{

    public static function byCriteria($uid, $hobbies, $preferences){
        $sql = "SELECT d.user_id,d.username,d.tag_line,d.city,d.gender,d.seeking,TIMESTAMPDIFF(YEAR, d.date_of_birth, CURDATE()) AS age,Total";
        $sql .= " FROM (SELECT c.user_id,c.username,c.tag_line,c.city,c.gender,c.seeking,c.date_of_birth,";
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
        if(!$last){$sql .= "Total";}
        $sql .= " FROM (SELECT b.*,";
        $n = 1;
        $last = count($hobbies);
        foreach($hobbies as $hobby){
            $sql .= "COALESCE(b.$hobby, 0)";
            if($n++ < $last){$sql .= "+";}
        }
        if(!$last){$sql .= "0";}
        $sql .= " AS Total FROM (SELECT a.user_id,a.username,a.tag_line,a.city,a.gender,a.seeking,a.date_of_birth";
        $n = 1;
        $last = count($preferences);
        foreach($preferences as $preference => $value){
            if($n++ <= $last){$sql .= ",";}
            $sql .= 'a.'.$preference;
        }
        $n = 1;
        $last = count($hobbies);
        foreach($hobbies as $hobby){
            if($n++ <= $last){$sql .= ",";}
            $sql .= "MAX(CASE WHEN a.hobby_id = '$hobby' THEN a.hobby_preference END)AS '$hobby'";
        }
        $n = 1;
        $last = count($preferences);
        $requiredPreferences = '';
        foreach($preferences as $preference => $value){
            if($n++ <= $last){$requiredPreferences .= ',';}
            $requiredPreferences .= $preference;
        }
        $sql .= " FROM (SELECT user_id,username,tag_line,city,gender,seeking,date_of_birth,hobby_id,hobby_preference$requiredPreferences";
        $sql .= " FROM registration_details JOIN preference_details USING(user_id)";
        $sql .= " JOIN user_hobby_preferences USING(user_id))a WHERE user_id != $uid GROUP BY user_id)b )c ORDER BY Total DESC)d WHERE Total > 0";
        $results = DB::getInstance()->query($sql)->results();
        return self::filterSeekingGender($uid, $results);
    }

    public static function suggestions($uid){
        $userHobbies = DB::getInstance()->query("SELECT hobby_id from user_hobby_preferences where user_id = $uid && hobby_preference = 1")->results();
        $hobby_ids = [];
        foreach($userHobbies as $hobby) {
            $hobby_ids[] =  $hobby->hobby_id;
        }
        $sql = "SELECT body_type,ethnicity,has_children,height,income,intent,marital_status,religion,smoker,wants_children";
        $sql .= " FROM preference_details WHERE user_id = $uid";
        $userPreferences = (array) DB::getInstance()->query($sql)->results()[0];
        return self::byCriteria($uid, $hobby_ids, $userPreferences);
    }

    public static function filterSeekingGender($uid, $results){
        $finalResults = [];
        $userPref = DB::getInstance()->query("SELECT gender,seeking FROM preference_details WHERE user_id = $uid")->results()[0];
        foreach($results as $result){
            $acceptResult = false;
            $resultAccept = false;
            if($userPref->seeking == 4){$acceptResult = true;}
            else{$acceptResult = ($userPref->seeking == $result->gender) ? true : false;}

            if($result->seeking == 4){$resultAccept = true;}
            else{$resultAccept = ($result->seeking == $userPref->gender) ? true: false;}

            if($acceptResult && $resultAccept) $finalResults[] = $result;
        }
        return $finalResults;
    }

    public static function filterAge($age, $results){
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

    public static function searchablePreferences(){
        return [
            'Body Type' => self::structureResult('body_type', 'id', 'choice'),
            'Ethnicity' => self::structureResult('ethnicity', 'id', 'choice'),
            'Has Children' => self::structureResult('has_children', 'id', 'choice'),
            'Height' => self::structureResult('height', 'id', 'choice'),
            'Income' => self::structureResult('income', 'id', 'choice'),
            'Intent' => self::structureResult('intent', 'id', 'choice'),
            'Marital Status' => self::structureResult('marital_status', 'id', 'choice'),
            'Religion' => self::structureResult('religion', 'id', 'choice'),
            'Smoker' => self::structureResult('smoker', 'id', 'choice'),
            'Wants Children' => self::structureResult('wants_children', 'id', 'choice')
        ];
    }

    private static function structureResult($table, $id, $choice){
        $results = DB::getInstance()->query("SELECT $id, $choice FROM $table")->results();
        $array = [];
        foreach($results as $result){
            $array[$result->$id] = $result->$choice;
        }
        return $array;
    }
}