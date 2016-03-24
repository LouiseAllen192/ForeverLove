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
                                $uid = 1; //need to change to global
                                //$uid = $_SESSION['user_id'];
                                $MsgMgr = new MessageMgr($uid);
                                if(!isset($_GET['convoID']))
                                    $convoID = $_SERVER['QUERY_STRING'];
                                else
                                    $convoID = ($_GET["convoID"]);
                                $user2_id = $MsgMgr ->getConversationPartner($convoID);
                                $nameArray = DB::getInstance()->query("SELECT username FROM registration_details WHERE user_id = '$user2_id'")->results();
                                $name = $nameArray[0]->username;
                                echo $name;
                            ?>
                        </strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                    <br><br>
                    <?php
                        $uid = 1; //need to change to global
                        //$uid = $_SESSION['user_id'];
                        $MsgMgr = new MessageMgr($uid);
                        if(!isset($_GET['convoID']))
                            $convoID = $_SERVER['QUERY_STRING'];
                        else
                        {
                            $convoID = ($_GET["convoID"]);
                            $MsgMgr->sendMessage($_GET["message"], $convoID);
                        }
                        $MsgMgr->loadConversation($convoID);

                        echo "<br>
                        <form role =\"form\" class=\"form-inline\" action=\"Conversation.php?.$convoID.#bottom\" method=\"get\">
                            <textarea rows=\"6\" cols=\"50\" name=\"message\"></textarea><br><br>
                            <input type=\"hidden\" name=\"convoID\" value=$convoID />
                            <input type=\"submit\" value=\"Submit\">
                        </form>";
                    ?>
                </p>

            </div>
        </div>
    </div>
    <a name="bottom"></a>
</div>
<?php include("includes/footer.html"); ?>
</body>

</html>