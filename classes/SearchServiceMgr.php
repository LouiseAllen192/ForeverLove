<?php
class SearchServiceMgr{
    public static function byUsername($username){
        $userReg =  DB::getInstance()->get('registration_details', ['Username', '=', $username]);
        if(!$userReg->count()) return 'No one with that username found';
        else return new User($userReg->results()[0]->user_id);
    }

    /*
     * I haven't tested this....
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
        $sql = "SELECT a.user_id FROM preference_details a JOIN hobbies b ON a.user_id = b.user_id where";
        while($n-- > 1){
            $sql .= " ? &&";
        }
        $sql .= " ?";

        /*
         * ********************
         * ********************
         * ********************
         */
        $results = DB::getInstance()->query($sql, $params)->results();
        $viewableProfiles = [];
        foreach($results as $result){
            $viewableProfiles[] = new User($result->User_id);
        }
        return $viewableProfiles;
    }
}