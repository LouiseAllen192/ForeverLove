<!DOCTYPE html>
<html>

<head>

    <?php include("includes/metatags.html");
    require_once 'core/init.php'; ?>
    <title>Conversation</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

</head>


<body class="full">
<?php include("includes/navbar.html"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong>
                            <?php
                                //$uid = 1; //need to change to global
                                $uid = $_SESSION['user_id'];
                                $MsgMgr = new MessageMgr($uid);
                                if(!isset($_POST['convoID']))
                                    $convoID = $_SERVER['QUERY_STRING'];
                                else
                                    $convoID = ($_POST["convoID"]);
                                if(!empty($convoID))
                                {
                                    if($MsgMgr->isUserInConversation($convoID)== true)
                                    {
                                        $user2_id = $MsgMgr->getConversationPartner($convoID);
                                        $vis = $MsgMgr->isProfileVisible($convoID);
                                        if(!$vis)
                                            $name = "Blind Date";
                                        else
                                            $name = $MsgMgr->getUsername($user2_id);
                                        echo $name;
                                    }
                                    else
                                        echo "Nobody.";
                                }
                                else
                                    echo "Invalid Conversation.";
                            ?>
                        </strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                    <br><br>
                    <?php
                        //$uid = 1; //need to change to global
                        $uid = $_SESSION['user_id'];
                        $MsgMgr = new MessageMgr($uid);
                        if(!isset($_POST['convoID']))
                            $convoID = $_SERVER['QUERY_STRING'];
                        else
                        {
                            $convoID = ($_POST["convoID"]);
                            $MsgMgr->sendMessage($_POST["message"], $convoID);
                        }
                        //if(isset($_POST[]))
                        if($MsgMgr->conversationExists($convoID))
                        {
                            if ($MsgMgr->isUserInConversation($convoID) == TRUE)
                                $MsgMgr->loadConversation($convoID);
                            else
                                echo "<div class=\"alert alert-danger\">
                                          Error - You are not invloved in this conversation!
                                      </div>";
                            $visible = $MsgMgr->isProfileVisible($convoID);
                            if (!$visible) {
                                $msgCount = $MsgMgr->messageCount($convoID);
                                echo "Message Count: " . $msgCount;
                                /*if($msgCount <= 25)
                                    echo "<form action=\"conversationPage.php?\".$convoID  method=\"post\">
                                            <button name=\"end\" value=\"end\" class=\"btn btn-warning\">Reveal User</button>
                                            <input type=\"hidden\" name=\"convo_id\" value=$convoID>
                                           </form>";*/
                                echo "<form action=\"blindDateEndPage.php\" method=\"post\">
                                        <button name=\"end\" value=\"end\" class=\"btn btn-warning\">End Conversation</button>
                                        <input type=\"hidden\" name=\"convo_id\" value=$convoID>
                                       </form>";
                            }
                        }
                        else
                            echo "<div class=\"alert alert-danger\">
                                   This Conversation Does Not Exist.
                                  </div>";
                    ?>
                </p>
                <div style = "text-align: left">
                    <a href="existingConversationPage.php"><h3>Back To Conversation List</h3></a>
                </div>
            </div>
        </div>
    </div>
    <a name="bottom"></a>
</div>
<?php include("includes/footer.html"); ?>
</body>
</html>