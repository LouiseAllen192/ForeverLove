<!DOCTYPE html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include($_SERVER['DOCUMENT_ROOT'] . '/classes/UserServiceMgr.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/classes/ReturnShortcuts.php');




    $valid = false;
    if (isset($source['month'])){$checkmonth = $source['month'];}
    $curryear = date("y");
    $currmonth = date("m");
    $checkyear = $value;
    if($curryear < $checkyear){$valid=true;}
    if($curryear == $checkyear && $currmonth < $checkmonth){$valid = true;}
    if(!$valid){
        $this->addError($item, 'error_valid_date');
    }

    ?>

    <title><?php echo $regOrUpdate?> Preferences</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <?php include("includes/fonts.html");?>



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
                        <strong>test</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                    <br>
                    <?php

                    $email = 'lilhy@gmail.com';


                    if(UserServiceMgr::checkIfEmailExists($email)){
                        echo 'TRUE';
                    }
                    else{
                        echo 'False';
                    }
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