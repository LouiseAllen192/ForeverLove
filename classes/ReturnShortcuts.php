<?php


class ReturnShortcuts
{

    public static function returnPreferences($uid){
        $preferences =  DB::getInstance()->get('preference_details', ['User_id', '=', $uid])->results()[0];
            $dbvalue = array("tag_line"=>$preferences->tag_line, "city"=>$preferences->city, "gender"=>$preferences->gender,
                              "seeking"=>$preferences->seeking, "intent"=>$preferences->intent, "date_of_birth"=>$preferences->date_of_birth,
                              "height"=>$preferences->height, "ethnicity"=>$preferences->ethnicity,"body_type"=>$preferences->body_type,
                              "religion"=>$preferences->religion, "marital_status"=>$preferences->marital_status,"income"=>$preferences->income,
                              "has_children"=>$preferences->has_children, "wants_children"=>$preferences->wants_children,
                              "smoker"=>$preferences->smoker, "drinker"=>$preferences->drinker, "about_me"=>$preferences->about_me);
            $finalResults =array();
        foreach($dbvalue as $key=>$value){

            if(strcmp($key ,"tag_line") != 0 && strcmp($key ,"city") != 0 && strcmp($key ,"date_of_birth") != 0 && strcmp($key ,"about_me") != 0 ){
                $pref = DB::getInstance()->get($key, ['id', '=', $value])->results()[0];
                $finalResults[$key]= $pref->choice;
            }
            else{
                $finalResults[$key]= $value;
            }
        }
        return $finalResults;
    }

    public static function returnHobbies($uid){
      $resultFinal = array();
        for($i=1; $i < 36; $i++) {
            $sql = "SELECT hobby_name, hobby_preference " .
                "FROM user_hobbies JOIN user_hobby_preferences USING(hobby_id) " .
                "WHERE user_id = '".$uid."' && hobby_id = '".$i."'";

            $results = DB::getInstance()->query($sql)->results();
            foreach ($results as $result) {
                $resultFinal[$result->hobby_name] = $result->hobby_preference;
            }
        }
        return $resultFinal;

    }

    public static function returnRegDetails($uid){
        $registrationDetails = DB::getInstance()->get('registration_details', ['user_id', '=', $uid])->results()[0];
            $dbvalue = array("username"=>$registrationDetails->username, "first_name"=>$registrationDetails->first_name,
                              "last_name"=>$registrationDetails->last_name, "password"=>$registrationDetails->password,
                              "email"=>$registrationDetails->email);
        return $dbvalue;

    }

    public static function returnHobbyNames(){
        $resultFinal = array();
        $sql = "SELECT hobby_name, hobby_id " .
            "FROM user_hobbies  ";

        $results = DB::getInstance()->query($sql)->results();
        foreach ($results as $result) {
            $resultFinal[$result->hobby_id] = $result->hobby_name;
        }
        return $resultFinal;
    }

    public static function returnOptionNames($tableName){
        $resultFinal = array();
        $sql = "SELECT * " .
            "FROM ".$tableName." ";

        $results = DB::getInstance()->query($sql)->results();
        foreach ($results as $result) {
            $resultFinal[$result->id] = $result->choice;
        }
        return $resultFinal;
    }


}