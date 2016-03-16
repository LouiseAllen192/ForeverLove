<?php

class MessageMgr
{

    private $userID;

    public function __construct($uid)
    {
        $this->userID = $uid;
    }

    public function doesConversationExist($user2ID)
    {
        //$ans = DB::getInstance()->get("converstaions", "['User1_id', '=', '$this->userID', 'OR', '$user2ID', 'AND', 'User2_id', '=', '$this->userID', 'OR' '$user2ID'') //("SELECT * FROM converstaions WHERE User1_id = $this->userID || $user2ID AND User2_id = $this->userID || $user2ID AND User1_id <> User2_id");
        //echo $ans;
        $ans = DB::getInstance()->query("SELECT * FROM converstaions WHERE (User1_id = $this->userID OR User1_id = $user2ID) AND (User2_id = $this->userID OR User2_id = $user2ID) AND User1_id <> User2_id ", [])->results();//SELECT * FROM converstaion WHERE User1_id = $this->userID || $user2ID AND User2_id = $this->userID || $user2ID AND User1_id <> User2_id ", [])->results();
        if(empty($ans))
        {
            echo "no hits";
            return false;
        }
        else
        {
            print_r($ans[0]);
            return true;
        }
    }

    public function sendMessage($message, $user2ID)
    {
        //todo
    }

    public function retriveConversations()
    {
        //todo
    }

    public function retriveMessages($ConversationID)
    {
        //todo
    }

    public static function testFunction($changes)
    {
        foreach ($changes as $key => $value)
        {
            echo $key . ' ---------   ' . $value . '<br>';
        }
    }

}
?>