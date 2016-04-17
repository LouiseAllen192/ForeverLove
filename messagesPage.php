<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Messages Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-messages-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

</head>


<body class="full">
<?php include("includes/navbar.php"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box page-middle">
            <div class="col-lg-12 text-center">


                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Messages</h2><br>
                    </div><br><br><br><br>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 text-center">
                        <a href ="newMessagePage.php"><img class="img-circle img-responsive img-center" src="includes/pics/NewMsg.jpg" alt="New Message Icon"></a>
                    </div>
                    <div class="col-lg-6 col-sm-6 text-center">
                        <a href = "existingConversationPage.php"><img class="img-circle img-responsive img-center" src="includes/pics/convo.jpg" alt="Existing Conversation Icon"></a>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6 col-sm-6 text-center">
                        <a href="newMessagePage.php"><h3>New Message</h3></a>
                    </div>
                    <div class="col-lg-6 col-sm-6 text-center">
                        <a href="existingConversationPage.php"><h3>Existing Conversation</h3></a>
                    </div>
                </div><br><br><br><br>
                <?php if($browser == 'IE') echo '<br><br><br><br><br>';?>

            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.html"); ?>
</body>
</html>