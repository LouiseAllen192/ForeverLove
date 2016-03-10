<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Contact Page</title>
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
                        <strong>Contact Us</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <br><br>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <p><br><br>Phone:</p>
                <hr class="tagline-divider"><br>
                <p>+00-12345678</p><br><br><br>
            </div>
            <div class="col-lg-12 text-center">
                <p>Email:</p>
                <hr class="tagline-divider"><br>
                <p>info@foreverlove.ie</p><br><br><br>
            </div>
            <div class="col-lg-12 text-center">
                <p>Address</p>
                <hr class="tagline-divider"><br>
                <p>72 Pearse Street<br>Sallynogin<br>Dublin 1<br>Co.Dublin</p><br><br><br><br>
            </div>
        </div>
    </div>


</div>
<?php include("includes/footer.html"); ?>
</body>

</html>