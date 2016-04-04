<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Settings Page</title>
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
                        <strong>Settings</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p><br>

                <div class = "panel panel-default">
                    <div class = "panel-body">

                        <br><br>
                        <a href="viewMembershipStatusPage.php">View membership status</a><br><br>
                        <a href="updateRegDetailsPage.php">Update your basic account details</a><br><br>
                        <a href="updatePassword.php">Update your password</a><br><br>
                        <a href="updatePreferencesPage.php">Update your prefrences</a><br><br>
                        <a href="updateHobbiesPage.php">Update your hobbies</a><br><br>

                        <br><br>
                        <br><br>

                    </div>
                </div>

                </p>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>