<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Search Page</title>
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
                        <strong>Search By Criteria</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                    <div class="container col-lg-12 col-md-12 col-sm-12">
                        <br><p>Preferences</p>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="checkbox" name="" id="" value="">test
                            </label>
                            <label class="btn btn-default">
                                <input type="checkbox" name="" id="" value="">test
                            </label>
                            <label class="btn btn-default">
                                <input type="checkbox" name="" id="" value="">test
                            </label>
                        </div>
                    </div>

                    <br><br>
                    <br><br>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>