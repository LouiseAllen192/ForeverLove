<!DOCTYPE html>
<html>
<head>
    <?php
    session_start();// DELETE
    $_SESSION['permissions'] = 'admin';// DELETE
    require_once '../core/init.php';
    include("../includes/metatags.html");
    include("../includes/fonts.html");

    ?>
    <title>Reports Page</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom-admin.css" rel="stylesheet">

</head>

<body class="full">
<?php include("../includes/navbarAdmin.html"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <hr class="tagline-divider">
                <h2>
                    <small>
                        <strong>Register New Admin Account</strong>
                    </small>
                </h2>
                <hr class="tagline-divider"><br>

            </div>
        </div>
    </div>
</div>
<?php include("../includes/footer.html"); ?>
</body>

</html>
