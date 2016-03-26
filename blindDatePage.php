<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Blind Date Page</title>
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
                        <strong>Blind Date</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                   <?php
                        if(!empty($_POST))
                        {
                            //$uid = 1; //temp - need to get from global array
                            $uid = $_SESSION['user_id'];
                            $msgMgr = new MessageMgr($uid);
                            $msgMgr->blindDateMatch();
                        }
                   ?>
                    <br>
                    Blind Date is the new way to find your soulmate!
                    <br><br>
                    Blind Date matches you anonymously with another user based soley on your sexual orientation, meaning that you could end up hitting it off with someone just like you, or you could find out if opposites attract!
                    <br><br>
                    If after a certain amount of messages have been exchanged between the two of you, you may choose to reveal your profiles to one another!
                    <br><br>
                    <?php
                        if(empty($_POST))
                            echo "<form action=\"blindDatePage.php\" method=\"post\">
                                    <button name=\"SignUp\" value=\"SignUp\" class=\"btn btn-warning\">Find Me A Blind Date!</button>
                                   </form>";
                    ?>
                </p>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>