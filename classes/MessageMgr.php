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

    public function sendMessage($message, $convoID)
    {
        $reciever_id = $this->getConversationPartner($convoID);
        $date = date('Y-m-d H:i:s');
        DB::getInstance()->insert('messages', ['Conversation_id' => $convoID, 'Sender_id' => $this->userID, 'Recipient_id'  => $reciever_id, 'Date_Received' => $date, 'Message_Text' => $message, 'Profile_Visable' => 1]);
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

    public function findConversations()
    {
        $convos = DB::getInstance()->query("SELECT * FROM conversations WHERE (User1_id = $this->userID) OR (User2_id = $this->userID)", [])->results();
        $messagedUsers = array();
        for($i = 0; $i < count($convos); $i++)
        {
            if($convos[$i]->user1_id == $this->userID)
                $tempUID = $convos[$i]->user2_id;
            else
                $tempUID = $convos[$i]->user1_id;
            $convoPartner = DB::getInstance()->query("SELECT username FROM registration_details WHERE user_id = '$tempUID'")->results();
            $messagedUsers[$i]=$convoPartner[0]->username;
            $tempConvoID = $convos[$i]->conversation_id;
            $linkString = "Conversation.php?".$tempConvoID."#bottom";
            echo "<a href= '".$linkString."''>$messagedUsers[$i]</a>";
        }
        if($i == 0)
            echo "No existing converations found.";
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

    public function loadConversation($convoID)
    {
        if(!empty($convoID))
        {
            $messages = DB::getInstance()->query("SELECT * FROM messages WHERE conversation_id = '$convoID' ORDER BY date_received")->results();
            for($i = 0; $i < count($messages); $i++)
            {
                if ($messages[$i]->sender_id == $this->userID)
                    $sender = "To:    ";
                else
                    $sender = "From:  ";
                echo ($sender . $messages[$i]->message_text) . "<br>";
            }
        }
        else //if user just types in URL without following appropriate link
            echo "Nothing to see here.";
    }

    public function getConversationPartner($convoID)
    {
        $convo = DB::getInstance()->query("SELECT * FROM conversations WHERE conversation_id = '$convoID'")->results();
        $user1 = $convo[0]->user1_id;
        $user2 = $convo[0]->user2_id;
        if($user1 == $this->userID)
            return $user2;
        else
            return $user1;
    }
}
?>