<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>View Membership status</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-viewMembership-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>
    <?php

    $uid = $_SESSION['user_id'];
    $dbvalues = ReturnShortcuts::returnAccDetails($uid);
    ?>

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
                        <strong>View Membership status</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>

                    <br><br>

                <div class = "panel panel-default">
                    <div class = "panel-body">

                            <br><br>
                            <div class= "line-right"> <strong>Membership type: </strong><br></div>
                            <div class="line-left"><?php echo $dbvalues['account_type'] ?><br><br><br></div>

<!--                            <div class="line-right"> <strong>Free trial used:  </strong><br></div>-->
<!--                            <div class="line-left">--><?php //echo ($dbvalues['free_trial_used'] == 0) ? "No" : "Yes" ?><!--<br><br><br></div>-->

                            <div class="line-right"> <strong>Account Expiry date:  </strong><br></div>
                            <div class="line-left"><?php echo $dbvalues['account_expired'] ?><br><br><br></div>

                        <?php if($dbvalues['account_type'] == "Free") {?>
                        <a href="upgradeMembership.php" class="btn btn-info center-inline" role="button"><span class="glyphicon glyphicon-star"></span> Upgrade to premium Membership</a>
                        <?php }?>


                    </div>
                </div>





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