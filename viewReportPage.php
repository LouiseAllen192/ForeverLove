<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Report Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-admin.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>
    <?php
        if(!empty($_GET)){
            $reportId = intval($_GET['Array']);
            $report = new BannedReport($reportId);
        }
    ?>
</head>

<body class="full">
<?php include("includes/navbarAdmin.html"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong>Report Page</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                <table style="width:50%" align="center">
                    <tr>
                        <td>Report ID:</td>
                        <td><?php echo $report->getReportId()?></td>
                    </tr>
                    <tr>
                        <td>Reporter:</td>
                        <td><?php echo $report-> getReporterId()?></td></td>
                    </tr>
                    <tr>
                        <td>Reportee:</td>
                        <td><?php echo $report-> getReporteeId()?></td>
                    </tr>
                    <tr>
                        <td>Details:</td>
                        <td><?php echo $report-> getContent()?></td>
                    </tr>
                    <tr>
                        <td>Resolved:</td>
                        <td><?php echo $report-> getResolved()?></td>
                </table>
                <br>
                <div class="dropdown">

                    </div>
                </div>

            </div>
         </div>
    </div>
</div>
<?php include("includes/footer.html"); ?>
</body>

</html>
