<!DOCTYPE html>
<html>
<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $result = DB::getInstance()->get('banned_reports', ['resolved', '=', '0'])->results()[0];
    ?>
    <title>Base Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-admin.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">

</head>

<body class="full">
<?php include("includes/navbar.html"); ?>

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
                <hr class="tagline-divider">

                <div class="row">
                    <p class="col-sm-2 col-xs-1"></p>
                    <div class="col-sm-8 col-xs-10">
                        <a href="viewReportPage.php?report_id=<?php echo $result->report_id;?>">
                            <div class="display_box">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="media">
                                            <!--<div class="media-left">
                                                <img class="media-object" src="https://s3.amazonaws.com/uifaces/faces/twitter/calebogden/73.jpg"/>
                                            </div>-->
                                            <div class="media-body media-left" style="padding-top: 3px;">
                                                <h4 class="media-heading"><?php echo $result->reportee_id; ?></h4>
                                            </div>
                                            <div class="media-body" style="padding-top: 3px;">
                                                <h4 class="media-heading"><?php echo $result->reporter_id; ?></h4>
                                                <small style="white-space: nowrap;"><?php echo $result->tag_line; ?></small>
                                            </div>
                                            <div class="media-right media-middle">
                                                <h5 class="media-heading"><?php echo $result->city; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.html"); ?>
</body>

</html>
