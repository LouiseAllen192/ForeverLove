<!DOCTYPE html>
<html>
<head>
    <?php
    session_start();// DELETE
    $_SESSION['permissions'] = 'admin';// DELETE
    require_once '../core/init.php';
    include("../includes/metatags.html");
    include("../includes/fonts.html");

    $reports = DB::getInstance()->query("SELECT * FROM banned_reports ORDER BY date_time DESC, priority DESC")->results();
    $priorities = SearchServiceMgr::getChoices('priority');
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
                        <strong>Reports</strong>
                    </small>
                </h2>
                <hr class="tagline-divider"><br>

                    <?php
                    if($reports){
                        foreach ($reports as $report) {
                            ?>
                            <div class="row">
                                <div class="col-xs-offset-2">
                                    <div class="col-xs-10">
                                        <a href="reportPage.php?report_id=<?php echo $report->report_id; ?>">
                                            <div class="display_box">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="media">
                                                            <div class="col-xs-2">
                                                                <div class="media-left media-middle" style="padding-top: 3px;">
                                                                    <h5 class="media-middle"><?php echo $report->date_time; ?></h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <div class="media-body" style="padding-top: 3px;">
                                                                    <h6 class="media-middle"><?php echo 'Reporter: '.UserServiceMgr::getUsername($report->reporter_id);?></h6>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <div class="media-body" style="padding-top: 3px;">
                                                                    <h6 class="media-middle"><?php echo 'Reportee: '.UserServiceMgr::getUsername($report->reportee_id);?></h6>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-2">
                                                                <div class="media-right media-middle">
                                                                    <h5 class="media-middle"><?php echo $priorities[$report->priority]; ?></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    else{?>
                        <div class= "alert alert-success" role="alert">
                            <p class="close" data-dismiss="alert" aria-label="close"></p>
                            All reports have been dealt with...
                        </div>
                    <?php
                    }
                    ?>
            </div>
        </div>
    </div>
</div>
<?php include("../includes/footer.html"); ?>
</body>

</html>
