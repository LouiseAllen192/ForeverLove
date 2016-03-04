<?php
class SearchServiceMgr{
    public static function username($username){
        $user =  DB::getInstance()->get('registration_details', ['Username', '=', $username]);
        if($user->count()) return $user->results();
    }
}