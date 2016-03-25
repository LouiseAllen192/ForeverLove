<!DOCTYPE html>
<html>

<head>

    <?php
        include("includes/metatags.html");
        require_once 'core/init.php';
    ?>
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
                    if(!empty($_POST))
                    {
                        //$uid = 1; //temp - need to get from global array
                        $uid = $_SESSION['user_id'];
                        $msgMgr = new MessageMgr($uid);
                        $msgMgr->sendNewMessage($_POST);
                    }
                    if(!empty($_SERVER['QUERY_STRING']))
                    {
                        $toID = $_SERVER['QUERY_STRING'];
                        $msgMgr2 = new MessageMgr($toID);
                        $to = $msgMgr2->getUsername();
                    }
                    else
                        $to = "";

                    echo "<form role =\"form\" class=\"form-inline\" action=\"newMessagePage.php\" method=\"post\">
                        To:<br>
                        <input type=\"text\" name=\"recipient\" value = $to><br>
                        Message:<br>
                        <textarea rows=\"6\" cols=\"50\" name=\"message\"></textarea><br><br>
                        <input type=\"submit\" value=\"Submit\">
                    </form>
                    <br><br>"
                    ?>
                <div style = "text-align: left">
                    <a href="messagesPage.php"><h3>Back To Message Page</h3></a>
                </div>
                </p>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>