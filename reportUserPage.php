<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>Report User</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

    <?php
    include($_SERVER['DOCUMENT_ROOT'].'/classes/User.php');

        $uid;

    ?>



</head>

<body class="full">
<?php include("includes/navbar.html"); ?>

<!--Main page content-->
<div class="container">


    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">Report User</h2>
                <hr>
                <hr class="visible-xs">
                <br>
                <div class="row">
                    <div class="col-md-12">

                        <div class = "panel panel-default">
                            <div class = "panel-body">

                                Insert report user page content here
                            </div>
                        </div>
            </div>
        </div>
    </div>




        <div class="row">
            <div class="box">
                <div class="col-lg-12">


                </div>
            </div>
        </div>

</div>
    <?php include("includes/footer.html"); ?>
</body>

</html>