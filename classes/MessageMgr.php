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
            echo "<div class=\"alert alert-danger\">
                      Message Not Sent - User Does Not Exist.
                  </div>";
        else
        {
            $convo_id = $this->doesConversationExist($reciever_id);
            if(!($convo_id))
            {
                $convo_id = $this->createConversation($reciever_id);
            }
            DB::getInstance()->insert('messages', ['Conversation_id' => $convo_id, 'Sender_id' => $this->userID, 'Recipient_id'  => $reciever_id, 'Date_Received' => $date, 'Message_Text' => $GET["message"], 'Profile_Visable' => 1]);
            echo "<div class=\"alert alert-success\">
                      Message Sent Succesfully.
                  </div>";
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
            $linkString = "conversationPage.php?".$tempConvoID."#bottom";
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
            $convoPartner = $this->getConversationPartner($convoID);
            $partnerName = $this->getUsername($convoPartner);
            echo"<div class = panel-group>";
            for($i = 0; $i < count($messages); $i++)
            {
                $dateAndTime = explode(" ", ($messages[$i]->date_received));
                $date = explode("-", $dateAndTime[0]);
                $tidyDate = $date[2]."/".$date[1]."/".$date[0]; //displays date forwards instead of backwards as it is stored
                $time = explode(":", $dateAndTime[1]);
                $tidyTime = $time[0].":".$time[1]; //removes seconds from time, so it's displayed in hours and mins
                $headerString = $partnerName." at ".$tidyTime." on ".$tidyDate;
                $messageText = $messages[$i]->message_text;
                if ($messages[$i]->sender_id == $this->userID)
                {
                    $sender = "To ";
                    echo "<div class=\"panel panel-success\" style = \"text-align: right\">
                      <div class=\"panel-heading\">$sender$headerString</div>
                      <div class=\"panel-body\">$messageText</div>
                    </div>";
                }
                else
                {
                    $sender = "From ";
                    echo "<div class=\"panel panel-info\" style = \"text-align: left\">
                      <div class=\"panel-heading\">$sender$headerString</div>
                      <div class=\"panel-body\">$messageText</div>
                    </div>";
                }
            }
            echo "</div><br>
                <form role =\"form\" class=\"form-inline\" action=\"conversationPage.php?.$convoID.#bottom\" method=\"post\">
                    <textarea rows=\"6\" cols=\"50\" name=\"message\"></textarea><br><br>
                    <input type=\"hidden\" name=\"convoID\" value=$convoID />
                    <input type=\"submit\" value=\"Submit\">
                </form>";
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

    public function getUsername($uid)
    {
        $user = DB::getInstance()->query("SELECT username FROM registration_details WHERE user_id = '$uid'")->results();
        return ($user[0]->username);
    }
}
?>