<!DOCTYPE html>
<html>

<head>

    <?php include("includes/metatags.html");
    require_once 'core/init.php'; ?>
    <title>New Message</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

</head>

<body class="full">
<?php include("includes/navbar.html");
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

                    //include($_SERVER['DOCUMENT_ROOT'].'/classes/MessageMgr.php');

                    //$uid = $_GLOBAL['User_Id'];

                    if(!empty($_GET))
                    {
                        //skipping checking if user/convo exists for now
                        echo $_GET["recipient"];
                        echo $_GET["message"];
                        $convoid = 1; //temp
                        $recieverid = 2; //temp
                        $uid = 1; //temp
                        $date = date('Y-m-d H:i:s');
                        echo"$date";
                        DB::getInstance()->insert('converstaions', ['User1_id' => $recieverid, 'User2_id'  => $uid]);
                        //DB::getInstance()->insert('messages', ['Conversation_id' => '1', 'Sender_id' => '$uid', 'Recipient_id'  => '$recieverid', 'Date_Recieved' => '$date', 'Message_Text' => '$_GET["message"]']);
                        echo "maybe sent idk";
                    }
                    else
                    {
                        echo"empty";
                    }
                    ?>
                    <form role ="form" class="form-inline" action="newMessagePage.php" method="get">
                        To:<br>
                        <input type="text" name="recipient""><br>
                        Message:<br>
                        <textarea rows="6" cols="50" name="message"></textarea><br><br>
                        <input type="submit" value="Submit">
                    </form>

                    <br><br>
                    <br><br>
                </p>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>