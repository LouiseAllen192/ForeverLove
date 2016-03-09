<?php


class ReturnShortcuts
{

    public function returnHobbies($uid){
        $prefrences = DB::getInstance()->get('preference_details', ['User_id', '=', $uid])->results()[0];
            $dbvalue = array("Tag_Line"=>$prefrences->Tag_Line, "City"=>$prefrences->City, "Gender"=>$prefrences->Gender,
                              "Seeking"=>$prefrences->Seeking, "Intent"=>$prefrences->Intent, "Date_Of_Birth"=>$prefrences->Date_Of_Birth,
                              "Height"=>$prefrences->Height, "Ethnicity"=>$prefrences->Ethnicity,"Body_Type"=>$prefrences->Body_Type,
                              "Religion"=>$prefrences->Religion, "Marital_Status"=>$prefrences->Marital_Status,"Income"=>$prefrences->Income,
                              "Has_Children"=>$prefrences->Has_Children, "Wants_Children"=>$prefrences->Wants_Children,
                              "Smoker"=>$prefrences->Smoker, "Drinker"=>$prefrences->Drinker, "About__Me"=>$prefrences->About__Me);
        return $dbvalue;
    }

    public function returnPreferences($uid){
        $hobbies = DB::getInstance()->get('hobbies', ['User_id', '=', $uid])->results()[0];
        $dbvalue = array("Reading"=>$hobbies->Reading, "Cinema"=>$hobbies->Cinema, "Shopping"=>$hobbies->Shopping,
            "Socializing"=>$hobbies->Socializing, "Travelling"=>$hobbies->Travelling, "Walking"=>$hobbies->Walking,
            "Exercise"=>$hobbies->Exercise, "Soccer"=>$hobbies->Soccer, "Dance"=>$hobbies->Dance,
            "Horses"=>$hobbies->Horses, "Painting"=>$hobbies->Painting, "Running"=>$hobbies->Running,
            "Eating_Out"=>$hobbies->Eating_Out, "Cooking"=>$hobbies->Cooking, "Computers"=>$hobbies->Computers,
            "Bowling"=>$hobbies->Bowling, "Writing"=>$hobbies->Writing, "Skiing"=>$hobbies->Skiing,
            "Crafts"=>$hobbies->Crafts, "Golf"=>$hobbies->Golf, "Chess"=>$hobbies->Chess,
            "Gymnastics"=>$hobbies->Gymnastics, "Cycle"=>$hobbies->Cycle, "Swimming"=>$hobbies->Swimming,
            "Surf"=>$hobbies->Surfing, "Hiking"=>$hobbies->Hiking, "Video_Games"=>$hobbies->Video_Games,
            "Volly_ball"=>$hobbies->Volly_Ball, "Badminton"=>$hobbies->Badminton, "Gym"=>$hobbies->Gym,
            "Parkour"=>$hobbies->Parkour, "Fashion"=>$hobbies->Fashion, "Yoga"=>$hobbies->Yoga,
            "Basketball"=>$hobbies->Basketball, "Boxing"=>$hobbies->Boxing, "Unique_Hobbie"=>$hobbies->Unique_Hobbie);
        return $dbvalue;

    }

    public function returnRegDetails($uid){
        $registrationDetails = DB::getInstance()->get('preference_details', ['User_id', '=', $uid])->results()[0];
            $dbvalue = array("Username"=>$registrationDetails->Username, "First_Name"=>$registrationDetails->First_Name,
                              "Last_Name"=>$registrationDetails->Last_Name, "Password"=>$registrationDetails->Password,
                              "Email"=>$registrationDetails->Email);
        return $dbvalue;

    }
}