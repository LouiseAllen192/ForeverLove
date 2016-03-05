<?php
class SearchServiceMgr{
    public static function byUsername($username){
        $userReg =  DB::getInstance()->get('registration_details', ['Username', '=', $username]);
        if(!$userReg->count()) return 'No one with that username found';
        else return new ViewableProfile($userReg->results()[0]->User_id);
    }

    /*
     * I haven't tested this.... in my head it works :P
     */
    public function byCriteria($prefernces = [], $hobbies = []){
        $n = 0;
        $params = [];
        foreach($prefernces as $prefernce){
            if($prefernce === true){
                $params[] = 'a'.$prefernce;
                $n++;
            }
        }
        foreach($hobbies as $hobby){
            if($hobby === true){
                $params[] = 'b'.$hobby;
                $n++;
            }
        }
        $sql = "SELECT a.User_id FROM preference_details a JOIN hobbies b ON a.User_id = b.User_id where";
        while($n-- > 1){
            $sql .= " ? &&";
        }
        $sql .= " ?";

        $results = DB::getInstance()->query($sql, $params)->results();
        $viewableProfiles = [];
        foreach($results as $result){
            $viewableProfiles[] = new ViewableProfile($result->User_id);
        }
        return $viewableProfiles;
    }
}