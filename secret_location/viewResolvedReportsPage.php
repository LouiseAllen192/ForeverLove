<!DOCTYPE html>
<html>
<head>
    <?php
    require_once '../core/init.php';
    include("../includes/metatags.html");
    include("../includes/fonts.html");

    $reports = DB::getInstance()->query("SELECT * FROM banned_reports WHERE resolved = '1' ORDER BY date_time DESC, priority DESC")->results();
    $priorities = SearchServiceMgr::getChoices('priority');

    $perPage = 10;
    $pageNum = (isset($_GET['pageNum'])) ? $_GET['pageNum'] : 1;
    $n = count($reports);
    $lastPage = intval(($n % $perPage == 0) ? $n / $perPage : ($n / $perPage) + 1);
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
                    $endPagination = ($pageNum == $lastPage) ? $n : $pageNum * $perPage;
                    for($i = ($pageNum * $perPage) - $perPage; $i < $endPagination; $i++){
                        ?>
                        <div class="row">
                            <div class="col-xs-offset-2">
                                <div class="col-xs-10">
                                    <a href="reportPage.php?report_id=<?php echo $reports[$i]->report_id; ?>">
                                        <div class="display_box">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="media">
                                                        <div class="col-xs-2">
                                                            <div class="media-left media-middle" style="padding-top: 3px;">
                                                                <h5 class="media-middle"><?php echo $reports[$i]->date_time; ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <div class="media-body" style="padding-top: 3px;">
                                                                <h6 class="media-middle"><?php echo 'Reporter: '.UserServiceMgr::getUsername($reports[$i]->reporter_id);?></h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <div class="media-body" style="padding-top: 3px;">
                                                                <h6 class="media-middle"><?php echo 'Reportee: '.UserServiceMgr::getUsername($reports[$i]->reportee_id);?></h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <div class="media-right media-middle">
                                                                <h5 class="media-middle"><?php echo $priorities[$reports[$i]->priority]; ?></h5>
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
                    if($n > $perPage){
                        ?>
                        <div style="margin: 20px;">
                            <ul class="pagination">
                                <li><a href="viewResolvedReportsPage.php?pageNum=<?php echo 1; ?>">&laquo;</a></li>
                                <?php
                                for($i = 1; $i <= $lastPage; $i++){?>
                                    <li><a href="viewResolvedReportsPage.php?pageNum=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                }
                                ?>
                                <li><a href="viewResolvedReportsPage.php?pageNum=<?php echo $lastPage; ?>">&raquo;</a></li>
                            </ul>
                        </div>
                        <?php
                    }
                }
                else{?>
                    <div class= "alert alert-success" role="alert">
                        <p class="close" data-dismiss="alert" aria-label="close"></p>
                        No reports to view...
                    </div>
                    <?php
                }
                ?>

                <br><br>
                <a href="../secret_location/adminHomePage.php" class="btn btn-info pull-left" role="button"><span class="glyphicon glyphicon-chevron-left"></span> Back To Menu</a>

            </div>
        </div>
    </div>
</div>
<?php include("../includes/footer.html"); ?>
</body>

</html>
