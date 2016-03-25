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
                                if(!isset($_POST['convoID']))
                                    $convoID = $_SERVER['QUERY_STRING'];
                                else
                                    $convoID = ($_POST["convoID"]);
                                if(!empty($convoID))
                                {
                                    $user2_id = $MsgMgr->getConversationPartner($convoID);
                                    $nameArray = DB::getInstance()->query("SELECT username FROM registration_details WHERE user_id = '$user2_id'")->results();
                                    $name = $nameArray[0]->username;
                                    echo $name;
                                }
                                else
                                    echo "Invalid Conversation";
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
                        if(!isset($_POST['convoID']))
                            $convoID = $_SERVER['QUERY_STRING'];
                        else
                        {
                            $convoID = ($_POST["convoID"]);
                            $MsgMgr->sendMessage($_POST["message"], $convoID);
                        }
                        $MsgMgr->loadConversation($convoID);
                    ?>
                </p>
                <div style = "text-align: left">
                    <a href="existingConversationPage.php"><h3>Back</h3></a>
                </div>
            </div>
        </div>
    </div>
    <a name="bottom"></a>
</div>
<?php include("includes/footer.html"); ?>
</body>
</html>