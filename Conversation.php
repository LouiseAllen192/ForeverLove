<!DOCTYPE html>
<html>

<head>

    <?php include("includes/metatags.html");
    require_once 'core/init.php'; ?>
    <title>Conversation</title>
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
                        <strong>Heading</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>

                    <br><br>
                    <?php
                    echo $_SERVER['QUERY_STRING'];?>

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