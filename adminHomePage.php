<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Admin HomePage</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-admin.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

</head>

<body class="full">
<?php include("includes/navbarAdmin.html"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong>Please Choose From The Following</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <form method="get" action="viewBannedUsersPage.php"><br>
                <input type="submit" value="View Banned Users" name="bannedUsers"/>
                </form>
                <form method="get" action="ChooseReportPage.php">
                <br>
                <input type="submit" value="View Unresolved" name="unres"/>
                <br><br>
                <input type="submit" value="View Resolved" name="res"/>
                </form>
                    <br><br>

<!--                Log out user and return to home page - TODO-->
<!--                <a href="adminLoginPage.php">Logout</a><br><br>-->
            </div>
        </div>
    </div>
<?php include("includes/footer.html"); ?>
</body>

</html>