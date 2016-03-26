<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Choose Report Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-admin.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>
    <?php include("includes/navbarAdmin.html"); ?>
    <?php
    $reports;
    if(isset($_GET)){

        if(isset($_GET['unres']) == "View Unresolved") {
                $arrayOfReports = array('1', '3', '5');// temp for testing
                //$reports = DB::getInstance()->get('banned_reports', ['resolved', '=', '0']);
        }
        if ($_GET['res'] == "View Resolved") {
                $arrayOfReports = array('2', '4', '6');//temp for testing
                //$reports = DB::getInstance()->get('banned_reports', ['resolved', '=', '1']);
        }
    }
    ?>
    <?php
    function generateSelect($options = array()) {
       $html = '<select name='.$options.'>';
        foreach ($options as $option) {
            $html .= '<option'.'>'.$option.'</option>';
        }
        $html .= '</select><br><br>';
        echo $html;
    }
    ?>

</head>

<body class="full">

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <br><br>
            <h2>
                <small>
                    <strong>Report</strong>
                </small>
            </h2>
            <hr class="tagline-divider">
            <p>
                <br><br>
            <div class = "myInvForm" style="display: ">
                <form method="get" action="viewReportPage.php">
                    <fieldset class="form-group">
                        <label for="selectedReport">Choose Report To View</label>
                        <?php
                        generateSelect($arrayOfReports);
                        ?>
                        <input type="submit" value="submit" name="choice"/>
                    </fieldset>
                </form>
            </div>
            <br><br>
            <br><br>
            </p>
        </div>
    </div>
</div>
<?php include("includes/footer.html"); ?>
</body>

</html>

