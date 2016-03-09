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

            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong>Admin</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>

                    <br><br>
                    <a href="viewReportedCasesPage.php">View Reported Cases</a><br><br>
                    <a href="adminLoginPage.php">Logout</a><br><br>
                    <br><br>
                    <br><br>
                </p>
            </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>