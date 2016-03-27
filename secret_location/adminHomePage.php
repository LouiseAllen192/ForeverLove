<!DOCTYPE html>
<html>

<head>
    <?php
    session_start();// DELETE
    $_SESSION['permissions'] = 'admin';// DELETE
    require_once '../core/init.php';
    include("../includes/metatags.html");
    include("../includes/fonts.html");

    $unresolved = DB::getInstance()->query("SELECT report_id FROM banned_reports WHERE resolved = '0'")->count();
    if($unresolved == 0){$unresolved = '';}
    ?>
    <title>Admin HomePage</title>
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
                        <strong>Administration</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">

                <div class="row">
                    <div class="col-sm-4 col-xs-6">
                        <div class="dummy"></div>
                        <a href="#" class="thumbnail">
                            <div class="h4">
                                Banned Users
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-4 col-xs-6">
                        <div class="dummy"></div>
                        <a href="#" class="thumbnail">
                            <div class="h4">
                                Suspended Users<span class="badge">3</span>//echo
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-4 col-xs-6">
                        <div class="dummy"></div>
                        <a href="reportsPage.php" class="thumbnail">
                            <div class="h4">
                                Reports<span class="badge badge-notify"><?php echo $unresolved;?></span>
                            </div>
                        </a>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</div>
<?php include("../includes/footer.html"); ?>
</body>

</html>