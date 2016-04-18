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
        date_default_timezone_set("Europe/Dublin");
        $date = date('Y-m-d H:i:s', time());
        DB::getInstance()->insert('messages', ['Conversation_id' => $convoID, 'Sender_id' => $this->userID, 'Recipient_id' => $reciever_id, 'Date_Received' => $date, 'Message_Text' => $message, 'seen' => 0]);
    }

    public function sendNewMessage($GET)
    {
        $rec = ($GET["recipient"]);
        $date = date('Y-m-d H:i:s');
        $reciever_id = $this->doesRecipientExist($rec);
        $message = ($GET["message"]);
        if (!($reciever_id) || $reciever_id == $this->userID) //if reciver doesn't exist or is logged in
            return false;
        else
        {
            $convo_id = $this->doesConversationExist($reciever_id);
            if(!($convo_id)) //if no conversation between the users exists
            {
                $convo_id = $this->createConversation($reciever_id, 1);
            }
            DB::getInstance()->insert('messages', ['Conversation_id' => $convo_id, 'Sender_id' => $this->userID, 'Recipient_id' => $reciever_id, 'Date_Received' => $date, 'Message_Text' => $message, 'seen' => 0]);
            return $convo_id;
        }
    }

    public function findConversations()
    {
        $convos = DB::getInstance()->query("SELECT * FROM conversations WHERE (User1_id = $this->userID) OR (User2_id = $this->userID)", [])->results();
        for ($i = 0; $i < count($convos); $i++)
        {
            if($convos[$i]->user1_id == $this->userID)
                $tempUID = $convos[$i]->user2_id;
            else
                $tempUID = $convos[$i]->user1_id;
            $convoPartner = DB::getInstance()->query("SELECT * FROM registration_details WHERE user_id = '$tempUID'")->results();
            $messagedUser = ($convoPartner[0]->username);
            $otherUID = $convoPartner[0]->user_id;
            $tempConvoID = $convos[$i]->conversation_id;
            $linkString = "conversationPage.php?" . $tempConvoID . "#bottom";
            $vis = $this->isProfileVisible($tempConvoID);
            $unreadMessagesArray = DB::getInstance()->query("SELECT COUNT(*) as num FROM messages WHERE recipient_id = '$this->userID' AND seen = '0' AND conversation_id = $tempConvoID")->results();
            $unreadMessages = $unreadMessagesArray[0]->num;
            $image = DB::getInstance()->query("SELECT image_path FROM images WHERE user_id = $otherUID && image_id = '1'")->results()[0]->image_path;
            if($vis)//if not a blind date
            {
                if ($unreadMessages == 0) //if there's no messages waiting to be read
                    echo " <div class=\"row\">
                                <div class=\"well well-lg\">
                                    <a href= \"$linkString\">
                                        <div class=\"media - left\">
                                            <img height=\"78\" width=\"78\" class=\"media - object\" src=\"$image\"/>
                                        </div>$messagedUser</a>
                                </div>
                           </div>";
                else
                    echo " <div class=\"row\">
                                <div class=\"well well-sm\">
                                    <a href= \"$linkString\">
                                        <div class=\"media - left\">
                                            <img height=\"78\" width=\"78\" class=\"media - object\" src=\"$image\"/>
                                        </div>$messagedUser<br><br><br><span class=\"badge\">$unreadMessages</span>
                                    </a>
                                </div>
                           </div>";
            }
            else //if blind date
            {
                if ($unreadMessages == 0)
                    echo "<div class=\"well well-lg\">
                            <a href= \"$linkString\">Blind Date</a>
                           </div>";
                else
                    echo "<div class=\"well well-sm\">
                            <a href= \"$linkString\">Blind Date<br><br><br><span class=\"badge\">$unreadMessages</span></a>
                            </div>";
            }
        }
        if($i == 0)
            echo "<div class=\"alert alert-danger\">
                   No Conversations Found.
                  </div><br><br><br><br><br><br><br><br>";
    }

    public static function doesRecipientExist($recipientName)
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
        $ans = DB::getInstance()->query("SELECT conversation_id FROM conversations WHERE User1_id = '$this->userID' AND User2_id = '$recieverid' AND profile_visible = '$visible'")->results();
        return ($ans[0]->conversation_id);
    }

    public function loadConversation($convoID, $num)
    {
        if(!empty($convoID))
        {
            $num = $num++;
            $messages = DB::getInstance()->query("SELECT * FROM messages WHERE conversation_id = '$convoID' ORDER BY date_received DESC LIMIT $num")->results();
            $this->markMessagesAsRead($convoID);
            $vis = $this->isProfileVisible($convoID);
            if($vis)
            {
                $convoPartner = $this->getConversationPartner($convoID);
                $partnerName = $this->getUsername($convoPartner);
            }
            else
                $partnerName = "Blind Date";
            echo "<div class = panel-group>";
            for ($i = count($messages)-1; $i >= 0; $i--)
            {
                $dateAndTime = explode(" ", ($messages[$i]->date_received));
                $date = explode("-", $dateAndTime[0]);
                $tidyDate = $date[2] . "/" . $date[1] . "/" . $date[0]; //displays date forwards instead of backwards as it is stored
                $time = explode(":", $dateAndTime[1]);
                $tidyTime = $time[0] . ":" . $time[1]; //removes seconds from time, so it's displayed in hours and mins
                $headerString = $partnerName . " at " . $tidyTime . " on " . $tidyDate;
                $messageText = htmlspecialchars($messages[$i]->message_text, ENT_QUOTES);
                if ($messages[$i]->sender_id == $this->userID) //if sender is logged in
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
                    <input type=\"submit\" value=\"Send\">
                </form>";
            return $num;
        }
        else
        {//if user just types in URL without following appropriate link
            echo "Nothing to see here.";
            return false;
        }
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
        if (!empty($usersInConversation))
        {
            if ($this->userID == $usersInConversation[0]->user1_id || $this->userID == $usersInConversation[0]->user2_id)
                return true;
            else
                return false;
        }
        else
            return false;
    }

    public function blindDateMatch()
    {
        $message = $this->blindDateEligible();
        if ($message == "") {
            $user = DB::getInstance()->query("SELECT * FROM preference_details WHERE user_id = $this->userID")->results();
            $seeking = $user[0]->seeking;
            $gender = $user[0]->gender;
            /*if(($seeking == 2 || $seeking == 3 || $seeking == 4) && ($gender == 2 || $gender == 3))
            {*/
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
                    $convoID = $this->createConversation($allUsers[$i]->user_id, 0);
                    $id = $allUsers[$i]->user_id;
                    DB::getInstance()->query("DELETE FROM blind_date WHERE user_id = $id")->results();
                    DB::getInstance()->delete('blind_date', "user_id = $id"); //removes user from blind date DB when they've got a match
                    echo "<div class=\"alert alert-success\">
                               Blind Date Match Made! Go To Your Existing Conversations To Begin Chatting!
                                <a href=\"conversationPage.php?$convoID\"><h3>Take Me There!</h3></a></div>";
                }
                $i++;
            }
            if (!$matchFound) {
                DB::getInstance()->insert('blind_date', ['user_id' => $this->userID, 'seeking' => $seeking, 'gender' => $gender]);
                echo "<div class=\"alert alert-success\">
                       No suitible match availible at the moment, but you will be matched shortly. Keep checking you existing conversations page!
                      </div>";
            }
        } else
            echo "<div class=\"alert alert-danger\">
                   $message
                  </div>";
    }

    public function isProfileVisible($convo_id)
    {
        $vis = DB::getInstance()->query("SELECT profile_visible FROM conversations WHERE conversation_id = '$convo_id'")->results();
        if ($vis[0]->profile_visible == 1)
            return true;
        else
            return false;
    }

    public static function messageCount($convoID)
    {
        $array = DB::getInstance()->query("SELECT COUNT(*) AS 'count' FROM messages where conversation_id = '$convoID'")->results();
        $count = $array[0]->count;
        return $count;
    }

    public function revealButton($convoID)
    {
        $current = DB::getInstance()->query("SELECT reveal FROM conversations WHERE conversation_id = '$convoID'")->results();
        if ($current[0]->reveal == NULL)
            DB::getInstance()->query("UPDATE conversations SET reveal = '$this->userID' WHERE conversation_id = $convoID");
        /*else if($current[0]->reveal == $this->userID)
            echo "You already pressed the reveal button";*/
        else
            DB::getInstance()->query("UPDATE conversations SET profile_visible = '1' WHERE conversation_id = $convoID");
    }

    public function hasUserPressedReveal($convoID)
    {
        $current = DB::getInstance()->query("SELECT reveal FROM conversations WHERE conversation_id = '$convoID'")->results();
        if ($current[0]->reveal == $this->userID)
            return true;
        else
            return false;
    }

    public function conversationLoader($convoID, $num) //loads everything but heading and back button on conversation page
    {
        if ($this->isUserInConversation($convoID) == TRUE)
        {
            $this->loadConversation($convoID, $num);
            $visible = $this->isProfileVisible($convoID);
            if (!$visible)
            {
                $msgCount = self::messageCount($convoID);
                echo "Message Count: " . $msgCount;
                if ($msgCount >= 25 && !($this->hasUserPressedReveal($convoID)))
                    echo "<form action=\"conversationPage.php?$convoID#bottom\"  method=\"post\">
                            <button name=\"reveal\" value=\"reveal\" class=\"btn btn-warning\">Reveal User</button>
                           </form><br><br>";
                else if ($this->hasUserPressedReveal($convoID))
                    echo "<div class=\"alert alert-info\">
                           You have pressed to reveal your profile to your blind date and to see their profile. If they also press the button then the reveal will take place.
                          </div>";

                echo "<form action=\"blindDateEndPage.php\" method=\"post\">
                                        <button name=\"end\" value=\"end\" class=\"btn btn-warning\">End Conversation</button>
                                        <input type=\"hidden\" name=\"convo_id\" value=$convoID>
                                       </form>";
            }
            else
            {
                $uname = $this->getOtherUser($convoID);
                $uid2 = $this->doesRecipientExist($uname);
                echo "<br><br><form action=\"profilePage.php?uid=$uid2\" method=\"post\">
                        <button name=\"profile\" value=\"Profile\" class=\"btn btn-warning\">Take Me To $uname's Profile Page</button>
                       </form>";
            }
            echo "<br><br><form action=\"conversationPage.php?$convoID#bottom\"  method=\"post\">
                    <button name=\"reload\" value=\"reload\" class=\"btn btn-warning\">Check For New Messages</button>
                   </form><br><br>";
        }
        else
            echo "<div class=\"alert alert-danger\">
                      Error - You are not invloved in this conversation!
                  </div>";
    }

    public function blindDateEligible()
    {
        $alreadyIn = DB::getInstance()->query("SELECT * FROM blind_date WHERE user_id = $this->userID")->results();
        $currentBlindDate = DB::getInstance()->query("SELECT * FROM conversations WHERE (user1_id = $this->userID || user2_id = $this->userID) AND profile_visible = '0'")->results();
        $prefs = DB::getInstance()->query("SELECT * FROM preference_details WHERE user_id = $this->userID")->results();
        $seeking = $prefs[0]->seeking;
        $gender = $prefs[0]->gender;
        $values = ReturnShortcuts::returnAccDetails($this->userID);
        $acctype = $values['account_type'];
        $username = $this->getUsername();
        if ($acctype == 'Free')
            return "You must be a premium member to access Blind Date\r\n
                 <a href=\"../ForeverLove/upgradeMembership.php?internal=yes&username=$username\"><h4>Take Me To Upgrade Membership Page</h4></a>";
        else if (!empty($alreadyIn))
            return "We are working on finding you a match at present. Please be patient.";
        else if ($currentBlindDate)
            return "You currently have a blind date in your existing conversations. You must either reveal your profile to your partner or end the conversation to get another.";
        else if ($seeking == 1 || ($gender == 1 || $gender == 4))
            return "Gender And/Or Seeking Details Not Specified For Your Profile. You Must Update Them Before You Can Participate In Blind Date.
                       <a href =\"updatePreferencesPage.php\"><h4>Take Me To Update Preferences Page</h4></a>";
        else
            return "";
    }

    public function getOtherUser($convoID)
    {
        $convo_details = DB::getInstance()->query("SELECT * FROM conversations WHERE conversation_id = '$convoID'")->results();
        if ($convo_details[0]->user1_id == $this->userID)
            $otherUID = $convo_details[0]->user2_id;
        else
            $otherUID = $convo_details[0]->user1_id;
        $name = $this->getUsername($otherUID);
        return $name;
    }

    public function sendMessageButton($uid2) //adds sendMessage Button with appropriate link to user profile page
    {
        $existingConversation = DB::getInstance()->query("SELECT * FROM conversations WHERE ((user1_id = '$this->userID' AND user2_id = '$uid2') OR (user2_id = '$this->userID' AND user1_id = '$uid2')) AND profile_visible = '1'")->results();
        if (empty($existingConversation))
            echo "<br><br><a href=\"newMessagePage.php?$uid2\" class=\"btn btn-info center-inline\" role=\"button\"><span class=\"glyphicon glyphicon-envelope\"></span> Send message</a>";
        else {
            $cid = $existingConversation[0]->conversation_id;
            echo "<br><br><a href=\"conversationPage.php?$cid#bottom\" class=\"btn btn-info center-inline\" role=\"button\"><span class=\"glyphicon glyphicon-envelope\"></span> Send message</a>";
        }
    }

    public function markMessagesAsRead($convoID)
    {
        DB::getInstance()->query("UPDATE messages SET seen = '1' WHERE conversation_id = '$convoID' AND recipient_id = $this->userID");
    }

    public static function loadConversationAdmin($convoID, $num)
    {
        if (!empty($convoID))
        {
            $messages = DB::getInstance()->query("SELECT * FROM messages WHERE conversation_id = '$convoID' ORDER BY date_received DESC LIMIT $num")->results();
            $firstUser = $messages[0]->sender_id;
            $secondUser = $messages[0]->recipient_id;
            echo "<div class = panel-group>";
            for ($i = count($messages)-1; $i >= 0; $i--)
            {
                $sender = $messages[$i]->sender_id;
                $sName = self::findUsername($sender);
                $dateAndTime = explode(" ", ($messages[$i]->date_received));
                $date = explode("-", $dateAndTime[0]);
                $tidyDate = $date[2] . "/" . $date[1] . "/" . $date[0]; //displays date forwards instead of backwards as it is stored
                $time = explode(":", $dateAndTime[1]);
                $tidyTime = $time[0] . ":" . $time[1]; //removes seconds from time, so it's displayed in hours and mins
                $headerString = "From " . $sName . " at " . $tidyTime . " on " . $tidyDate;
                $messageText = htmlspecialchars($messages[$i]->message_text, ENT_QUOTES);
                if ($messages[$i]->sender_id == $firstUser) //different users mesages displayed in different colours
                {
                    echo "<div class=\"panel panel-info\" style = \"text-align: left\">
                      <div class=\"panel-heading\">$headerString</div>
                      <div class=\"panel-body\">$messageText</div>
                    </div>";
                }
                else
                {
                    echo "<div class=\"panel panel-success\" style = \"text-align: right\">
                      <div class=\"panel-heading\">$headerString</div>
                      <div class=\"panel-body\">$messageText</div>
                    </div>";
                }
            }
            echo "</div><br>";
        } else //if user just types in URL without following appropriate link
            echo "Nothing to see here.";
    }

    public static function findUsername($uid)
    {
        $user = DB::getInstance()->query("SELECT username FROM registration_details WHERE user_id = '$uid'")->results();
        if (!empty($user))
            return ($user[0]->username);
        else
            return "";
    }

    public  static  function addMessages()
    {
        $date = date('Y-m-d h:i:s', time());
        for($i = 0; $i < 100; $i++)
        {
            DB::getInstance()->query("INSERT INTO messages (conversation_id, sender_id, recipient_id, date_received, message_text, seen) VALUES ('23', '1', '7', '$date', '$i', '0')");
        }
    }
}
?>