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
                                if(isset($_POST['reveal']))
                                {
                                    $MsgMgr->revealButton($convoID);
                                }
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

                        if($MsgMgr->conversationExists($convoID))
                            $MsgMgr->conversationLoader($convoID);
                        else
                            echo "<div class=\"alert alert-danger\">
                                   This Conversation Does Not Exist.
                                  </div>";
                    ?>
                </p>
                <div style = "text-align: left">
                    <a href="existingConversationPage.php"><h3>Back To Conversation List</h3></a>
                </div>
                <?php include("includes/navbar.php"); ?>
            </div>
        </div>
    </div>
    <a name="bottom"></a>
</div>
<?php include("includes/footer.html"); ?>
</body>
</html>