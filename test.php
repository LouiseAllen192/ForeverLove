<!DOCTYPE html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include($_SERVER['DOCUMENT_ROOT'] . '/classes/UserServiceMgr.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/classes/ReturnShortcuts.php');

    //$uid = $_SESSION['user_id'];
    $uid = 1;
    ?>

    <title>test</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <?php include("includes/fonts.html");?>


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
                        <strong>test</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                    <br>
                <?php
                $hobbies = ReturnShortcuts::returnHobbies($uid);
                foreach($hobbies as $key=>$value){echo $key.'---'.$value.'<br>';}

                ?>
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