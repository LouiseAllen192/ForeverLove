<!DOCTYPE html>
<html>

<head>
    <?php
    session_start();// DELETE
    $_SESSION['permissions'] = 'admin';// DELETE
    require_once '../core/init.php';
    include("../includes/metatags.html");
    include("../includes/fonts.html");

    $banned = DB::getInstance()->query("SELECT DISTINCT user_id FROM banned_users WHERE permanent = '1'")->count();
    $suspended = DB::getInstance()->query("SELECT DISTINCT user_id FROM banned_users WHERE permanent = '0'")->count();
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
                        <a href="viewBannedUsersPage.php" class="thumbnail">
                            <div class="h4">
                                Banned Users<span class="badge"><?php echo $banned;?></span>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-4 col-xs-6">
                        <div class="dummy"></div>
                        <a href="#" class="thumbnail">
                            <div class="h4">
                                Suspended Users<span class="badge"><?php echo $suspended;?></span>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-4 col-xs-6">
                        <div class="dummy"></div>
                        <a href="viewReportsPage.php" class="thumbnail">
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