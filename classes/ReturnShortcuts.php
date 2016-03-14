<?php


class ReturnShortcuts
{

    public static function returnPreferences($uid){
        $preferences = DB::getInstance()->get('preference_details', ['User_id', '=', $uid])->results()[0];
            $dbvalue = array("Tag_Line"=>$preferences->Tag_Line, "City"=>$preferences->City, "Gender"=>$preferences->Gender,
                              "Seeking"=>$preferences->Seeking, "Intent"=>$preferences->Intent, "Date_Of_Birth"=>$preferences->Date_Of_Birth,
                              "Height"=>$preferences->Height, "Ethnicity"=>$preferences->Ethnicity,"Body_Type"=>$preferences->Body_Type,
                              "Religion"=>$preferences->Religion, "Marital_Status"=>$preferences->Marital_Status,"Income"=>$preferences->Income,
                              "Has_Children"=>$preferences->Has_Children, "Wants_Children"=>$preferences->Wants_Children,
                              "Smoker"=>$preferences->Smoker, "Drinker"=>$preferences->Drinker, "About__Me"=>$preferences->About__Me);
        return $dbvalue;
    }

    public static function returnHobbies($uid){
        $hobbies = DB::getInstance()->get('hobbies', ['User_id', '=', $uid])->results()[0];
        $dbvalue = array("Reading"=>$hobbies->Reading, "Cinema"=>$hobbies->Cinema, "Shopping"=>$hobbies->Shopping,
            "Socializing"=>$hobbies->Socializing, "Travelling"=>$hobbies->Travelling, "Walking"=>$hobbies->Walking,
            "Exercise"=>$hobbies->Exercise, "Soccer"=>$hobbies->Soccer, "Dancing"=>$hobbies->Dancing,
            "Horses"=>$hobbies->Horses, "Painting"=>$hobbies->Painting, "Running"=>$hobbies->Running,
            "Eating_Out"=>$hobbies->Eating_Out, "Cooking"=>$hobbies->Cooking, "Computers"=>$hobbies->Computers,
            "Bowling"=>$hobbies->Bowling, "Writing"=>$hobbies->Writing, "Skiing"=>$hobbies->Skiing,
            "Crafts"=>$hobbies->Crafts, "Golf"=>$hobbies->Golf, "Chess"=>$hobbies->Chess,
            "Gymnastics"=>$hobbies->Gymnastics, "Cycling"=>$hobbies->Cycling, "Swimming"=>$hobbies->Swimming,
            "Surfing"=>$hobbies->Surfing, "Hiking"=>$hobbies->Hiking, "Video_Games"=>$hobbies->Video_Games,
            "Volleyball"=>$hobbies->Volleyball, "Badminton"=>$hobbies->Badminton, "Gym"=>$hobbies->Gym,
            "Parkour"=>$hobbies->Parkour, "Fashion"=>$hobbies->Fashion, "Yoga"=>$hobbies->Yoga,
            "Basketball"=>$hobbies->Basketball, "Boxing"=>$hobbies->Boxing, "Unique_Hobbie"=>$hobbies->Unique_Hobbie);
        return $dbvalue;


    }

    public static function returnRegDetails($uid){
        $registrationDetails = DB::getInstance()->get('registration_details', ['User_id', '=', $uid])->results()[0];
            $dbvalue = array("Username"=>$registrationDetails->Username, "First_Name"=>$registrationDetails->First_Name,
                              "Last_Name"=>$registrationDetails->Last_Name, "Password"=>$registrationDetails->Password,
                              "Email"=>$registrationDetails->Email);
        return $dbvalue;

    }
}