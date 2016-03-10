<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Messages Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

</head>

<body class="full">
<?php include("includes/navbar.html"); ?>

<!--Main page content-->

<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Messages</h2>
            </div>
            <div class="col-lg-6 col-sm-6 text-center">
                <a href ="newMessage.php"><img class="img-circle img-responsive img-center" src="includes/pics/NewMsg.jpg" alt="New Message Icon"></a>
                <a href="newMessage.php"><h3>New Message</h3></a>
                <p><br></p>
            </div>
            <div class="col-lg-6 col-sm-6 text-center">
                <a href = "existingConversation.php"><img class="img-circle img-responsive img-center" src="includes/pics/convo.jpg" alt="Existing Conversation Icon"></a>
                <a href="existingConversation.php"><h3>Existing Conversation</h3></a>
                <p><br></p>
            </div>
		</div>
</div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>