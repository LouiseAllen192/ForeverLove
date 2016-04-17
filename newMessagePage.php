<!DOCTYPE html>
<html>

<head>

    <?php
        include("includes/metatags.html");
        require_once 'core/init.php';
        include("includes/fonts.html");
        if(!empty($_POST))
        {
            if($_POST["message"] != "")
            {
                $uid = $_SESSION['user_id'];
                $msgMgr = new MessageMgr($uid);
                $convoID = $msgMgr->sendNewMessage($_POST);
                if ($convoID != false)
                    header("Location: conversationPage.php?$convoID#bottom");
            }
        }
    ?>
    <title>New Message</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-new-msg.css" rel="stylesheet">
</head>

<body class="full">
<?php include("includes/navbar.php");
?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong>New Message</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>

                    <br><br>
                    <?php
                    if(!empty($_POST))
                    {
                        if($_POST["message"] == "")
                            echo "<div class=\"alert alert-danger\">
                                  Message Not Sent - You Cannot Send A Blank Message.
                              </div>";
                        else
                        {
                            $uid = $_SESSION['user_id'];
                            $uid2 = MessageMgr::doesRecipientExist($_POST["recipient"]);
                            if ($uid == $uid2)
                                echo "<div class=\"alert alert-danger\">
                                  Message Not Sent - You Cannot Message Yourself.
                                 </div>";
                            else
                                echo "<div class=\"alert alert-danger\">
                                  Message Not Sent - Username Entered Does Not Exist.
                                 </div>";
                        }
                    }
                    if(!empty($_SERVER['QUERY_STRING']))
                    {
                        $toID = $_SERVER['QUERY_STRING'];
                        $msgMgr2 = new MessageMgr($toID);
                        $to = $msgMgr2->getUsername();
                    }
                    else
                        $to = "";

                    echo "

                        <form role =\"form\" class=\"form-inline\" action=\"newMessagePage.php\" method=\"post\">
                            To:<br>
                            <input type=\"text\" name=\"recipient\" value = $to><br>
                            Message:<br>
                            <textarea rows=\"6\" cols=\"50\" name=\"message\"></textarea><br><br>
                            <input type=\"submit\" value=\"Submit\" class=\"btn btn-info\">
                        </form>

                    <br><br>"
                    ?>
                    <div style = "text-align: left">
                        <a href="messagesPage.php" class="btn btn-info" role="button"><span class="glyphicon glyphicon-chevron-left"></span> Back To Messages Page</a>
                    </div>
                </p>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>