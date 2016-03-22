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
        $ans = DB::getInstance()->query("SELECT * FROM conversations WHERE (User1_id = $this->userID OR User1_id = $user2ID) AND (User2_id = $this->userID OR User2_id = $user2ID) AND User1_id <> User2_id ", [])->results();
        if(empty($ans))
            return false;
        else
            return ($ans[0]->conversation_id);
    }

    public function sendMessage($message, $user2ID)
    {
        //todo
    }

    public function sendNewMessage($GET)
    {
        $rec = ($GET["recipient"]);
        $date = date('Y-m-d H:i:s');
        $reciever_id = $this->doesRecipientExist($rec);
        if(!($reciever_id))
            echo "user does not exist"; //must be updated to look better
        else
        {
            $convo_id = $this->doesConversationExist($reciever_id);
            if(!($convo_id))
            {
                $convo_id = $this->createConversation($reciever_id);
            }
            DB::getInstance()->insert('messages', ['Conversation_id' => $convo_id, 'Sender_id' => $this->userID, 'Recipient_id'  => $reciever_id, 'Date_Received' => $date, 'Message_Text' => $GET["message"], 'Profile_Visable' => 1]);
            echo "message sent"; //must be updated to look better
        }
    }

    public function retriveConversations()
    {
        //todo
    }

    public function retriveMessages($ConversationID)
    {
        //todo
    }

    public function findConversations()
    {
        //find conversations that involve the user
        $convos = DB::getInstance()->query("SELECT * FROM conversations WHERE (User1_id = $this->userID OR User2_id = $this->userID", [])->results();
        $messagedUsers = array();
        for($i = 0; $i < count($convos); $i++)
        {
            if($messagedUsers[$i]->user1_id == $this->userID)
                $temp = $messagedUsers[$i]->user2_id;
            else
                $temp = $messagedUsers[$i]->user1_id;
            $messagedUsers[$i]=$temp;
            echo $temp;
            //get usernames and display those
            //once that's done get messages
        }
    }

    public static function testFunction($changes)
    {
        foreach ($changes as $key => $value)
        {
            echo $key . ' ---------   ' . $value . '<br>';
        }
    }

    public function doesRecipientExist($recipientName)
    {
        $ans = DB::getInstance()->query("SELECT * FROM registration_details WHERE Username = '$recipientName'", [])->results();
        if(empty($ans))
            return false;//not sure about this
        else
            return ($ans[0]->user_id);
    }

    public function createConversation($recieverid)
    {
        DB::getInstance()->insert('Conversations', ['User1_id' => $this->userID, 'User2_id' => $recieverid]);
        $ans = DB::getInstance()->query("SELECT conversation_id FROM conversations WHERE User1_id = '$this->userID' AND User2_id = '$recieverid'")->results();
        return ($ans[0]->conversation_id);
    }
}
?>