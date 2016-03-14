<?php

class MessageServiceMgr
{

    private $userID;

    public function __construct($uid)
    {
        $this->userID = $uid;
    }

    public function doesConversationExist($user2ID)
    {
        //todo
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