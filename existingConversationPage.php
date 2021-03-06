<!DOCTYPE html>
<html>

<head>

    <?php include("includes/metatags.html");
    require_once 'core/init.php'; ?>
    <title>Conversations</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

</head>

<body class="full">
<?php include("includes/navbar.php"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong>Conversations</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>

                    <br><br>
                    <?php

                        $uid = $_SESSION['user_id'];
                        $msgMgr = new MessageMgr($uid);
                        $msgMgr->findConversations();
                    ?>

                    <?php include("includes/navbar.php"); ?>

                    <br><br>
                    <br><br>

                </p>
                <a href="messagesPage.php" class="btn btn-info" role="button" style = "text-align: left"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.html"); ?>
</body>

</html>