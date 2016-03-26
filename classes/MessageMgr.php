<?php

class MessageMgr
{

    private $userID;

    public function __construct($uid)
    {
        $this->userID = $uid;
    }
    public function conversationExists($convoID)
    {
        $ans = DB::getInstance()->query("SELECT * FROM conversations WHERE conversation_id = '$convoID'")->results();
        if(empty($ans))
            return false;
        else
            return true;
    }
    public function doesConversationExist($user2ID)
    {
        $ans = DB::getInstance()->query("SELECT * FROM conversations WHERE (User1_id = $this->userID OR User1_id = $user2ID) AND (User2_id = $this->userID OR User2_id = $user2ID) AND (User1_id <> User2_id) AND profile_visible = '1' ", [])->results();
        if(empty($ans))
            return false;
        else
            return ($ans[0]->conversation_id);
    }

    public function sendMessage($message, $convoID)
    {
        $reciever_id = $this->getConversationPartner($convoID);
        $date = date('Y-m-d H:i:s');
        DB::getInstance()->insert('messages', ['Conversation_id' => $convoID, 'Sender_id' => $this->userID, 'Recipient_id'  => $reciever_id, 'Date_Received' => $date, 'Message_Text' => $message, 'seen' => 0]);
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
                $convo_id = $this->createConversation($reciever_id, 1);
            }
            DB::getInstance()->insert('messages', ['Conversation_id' => $convo_id, 'Sender_id' => $this->userID, 'Recipient_id'  => $reciever_id, 'Date_Received' => $date, 'Message_Text' => $GET["message"], 'seen' => 0]);
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
            $vis = $this->isProfileVisible($tempConvoID);
            if($vis)
                echo "<a href= '".$linkString."''>$messagedUsers[$i]</a><br><br>";
            else
                echo "<a href= '".$linkString."''>Blind Date</a><br><br>";
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

    public function createConversation($recieverid, $visible)
    {
        DB::getInstance()->insert('Conversations', ['User1_id' => $this->userID, 'User2_id' => $recieverid, 'profile_visible' => $visible]);
        $ans = DB::getInstance()->query("SELECT conversation_id FROM conversations WHERE User1_id = '$this->userID' AND User2_id = '$recieverid'")->results();
        return ($ans[0]->conversation_id);
    }

    public function loadConversation($convoID)
    {
        if(!empty($convoID))
        {
            $messages = DB::getInstance()->query("SELECT * FROM messages WHERE conversation_id = '$convoID' ORDER BY date_received")->results();
            $vis = $this->isProfileVisible($convoID);
            if($vis)
            {
                $convoPartner = $this->getConversationPartner($convoID);
                $partnerName = $this->getUsername($convoPartner);
            }
            else
                $partnerName = "Blind Date";
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

    public function getUsername()
    {
        if(func_num_args() > 0)
            $uid = func_get_arg(0);
        else
            $uid = $this->userID;
        $user = DB::getInstance()->query("SELECT username FROM registration_details WHERE user_id = '$uid'")->results();
        if(!empty($user))
            return ($user[0]->username);
        else
            return "";
    }

    public function isUserInConversation($convoID)
    {
        $usersInConversation = DB::getInstance()->query("SELECT user1_id, user2_id FROM conversations WHERE conversation_id = '$convoID'")->results();
        if(!empty($usersInConversation))
        {
            if($this->userID == $usersInConversation[0]->user1_id || $this->userID == $usersInConversation[0]->user2_id)
                return true;
            else
                return false;
        }
        else
            return false;
    }

    public function blindDateMatch()
    {
        $alreadyIn = DB::getInstance()->query("SELECT * FROM blind_date WHERE user_id = $this->userID")->results();
        if(empty($alreadyIn))//THIS IS NOT FINISHED
        {
            $user = DB::getInstance()->query("SELECT * FROM preference_details WHERE user_id = $this->userID")->results();
            $seeking = $user[0]->seeking;
            $gender = $user[0]->gender;
            if(($seeking == 2 || $seeking == 3 || $seeking == 4) && ($gender == 2 || $gender == 3))
            {
                //get all people from Blind Date table here and try to find an eligible match
                $allUsers = DB::getInstance()->query("SELECT * FROM blind_date")->results();
                $matchFound = false;
                $i = 0;
                while (!$matchFound && $i < count($allUsers))
                {
                    $otherUserSeeking = $allUsers[$i]->seeking;
                    $otherUserGender = $allUsers[$i]->gender;
                    if (($seeking == 4 || $seeking == $otherUserGender) && ($otherUserSeeking == 4 || $otherUserSeeking == $gender))
                    {
                        $matchFound = true;
                        $this->createConversation($allUsers[$i]->user_id, 0);
                        $id = $allUsers[$i]->user_id;
                        DB::getInstance()->query("DELETE FROM blind_date WHERE user_id = $id")->results();
                        //DB::getInstance()->delete('blind_date', "user_id = $allUsers[$i]->user_id");
                        echo "<div class=\"alert alert-success\">
                               Blind Date Match Made! Go To Your Existing Conversations To Begin Chatting!
                                <a href=\"existingConversationPage.php\"><h3>Take Me There!</h3></a></div>";
                    }
                    $i++;
                }
                if(!$matchFound)
                {
                    DB::getInstance()->insert('blind_date', ['user_id' => $this->userID, 'seeking' => $seeking, 'gender' => $gender]);
                    echo "<div class=\"alert alert-success\">
                       No suitible match availible at the moment, but you will be matched shortly. Keep checking you existing conversations page!
                      </div>";
                }
            }
            else
                echo "<div class=\"alert alert-danger\">
                       Gender And/Or Seeking Details Not Specified For Your Profile. You Must Update Them Before You Can Participate In Blind Date.
                      </div>
                      <a href =\"updatePreferencesPage\"><h3>Take Me To Update Preferences Page</h3></a></div>";

        }
        else
            echo "<div class=\"alert alert-danger\">
                   You are already signed up to find a blind date. You will be matched with someone shortly!
                  </div>";
    }
    public function isProfileVisible($convo_id)
    {
        $vis = DB::getInstance()->query("SELECT profile_visible FROM conversations WHERE conversation_id = '$convo_id'")->results();
        if($vis[0]->profile_visible == 1)
            return true;
        else
            return false;
    }

    public function messageCount($convoID)
    {
        $array = DB::getInstance()->query("SELECT COUNT(*) AS 'count' FROM messages where conversation_id = '$convoID'")->results();
        $count = $array[0]->count;
        return $count;
    }
}
?>