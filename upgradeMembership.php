<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");

    // **********************************************
    $uid = $_SESSION['user_id'];
    $acc;
    $length;

    $errors = UserServiceMgr::validateCreditCardDetails($_POST);

    if(isset($_POST['security']) && !($errors)){
        if(UserServiceMgr::validateCreditCard($uid, $_POST)){
            $length = $_POST['length'];
            UserServiceMgr::registerAccountType($uid, $length);
            header('Location: updatePreferencesPage.php');
            die();
        }
        else{ echo 'Fail!!!!';
            ?>
            <div class="alert alert-danger">
                <a href="registerAccountTypePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p><strong>Something went wrong</strong> - The Credit Card details you entered are not valid.</p>
            </div>
        <?php }
    }
    // **************************************************
    ?>




    <title>View Membership status</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <script src="bootstrap_js/jquery.js"></script>
    <script src="scripts/accountType.js"></script>

    <?php include("includes/fonts.html"); ?>
    <?php


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
                        <strong>Upgrade Membership status</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>

                    <br><br>

                <div class = "panel panel-default">
                    <div class = "panel-body">

                        <br><br>

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