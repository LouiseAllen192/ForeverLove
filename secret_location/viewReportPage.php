<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<head>
    <?php
    session_start();// DELETE
    $_SESSION['permissions'] = 'admin';// DELETE
    require_once '../core/init.php';
    include("../includes/metatags.html");
    include("../includes/fonts.html");

    $report_id = 1;//$_GET['report_id'];
    $db = DB::getInstance();
    $report = $db->get('banned_reports', ['report_id', '=', $report_id])->results()[0];
    $priorities = SearchServiceMgr::getChoices('priority');
    $reporter = $db->query("SELECT username FROM registration_details WHERE user_id = '$report->reporter_id'")->results()[0]->username;
    $reportee = $db->query("SELECT username FROM registration_details WHERE user_id = '$report->reportee_id'")->results()[0]->username;

    ?>
    <title>Report Page</title>
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
                <h2>
                    <small>
                        <strong>Report</strong>
                    </small>
                </h2>
                <hr class="tagline-divider"><br>




            </div>
         </div>
    </div>
</div>
<?php include("../includes/footer.html"); ?>
</body>

</html>
