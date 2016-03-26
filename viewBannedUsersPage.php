<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Banned Users Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-admin.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>
    <?php
    $arrayOfBannedUsers = array(); $i = 0;
   // $bannedUserId = DB::getInstance()->query("SELECT user_id FROM banned_reports WHERE user_id != 'null'",[]);
    $bannedUserId = array('1'); // temporary
    for ($i = 0; $i < count($bannedUserId); ) {
        $arrayOfBannedUsers = new BannedUser($bannedUserId[$i]);
        $i++;
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
                    <strong>Banned Users</strong>
                </small>
            </h2>
            <hr class="tagline-divider">
            <?php
             $j=0;
            for($j = 0; $j < count($bannedUserId); $j++)
            {
            ?>
            <table style="width:50%" align="center">
                <tr>
                    <td>User ID:</td>
                    <td><?php echo $arrayOfBannedUsers->getUserId()?></td>
                </tr>
                <tr>
                    <td>Report ID:</td>
                    <td><?php echo $arrayOfBannedUsers->getReportId()?></td></td>
                </tr>
                <tr>
                    <td>Start Date:</td>
                    <td><?php echo $arrayOfBannedUsers->getStartDate()?></td>
                </tr>
                <tr>
                    <td>End Date:</td>
                    <td><?php echo $arrayOfBannedUsers->getEndDate()?></td>
                </tr>
                <br><br>
                <tr></tr>
            <?php } ?>
            </table>
            </tr>
            <!--                Log out user and return to home page - TODO-->
            <!--                <a href="adminLoginPage.php">Logout</a><br><br>-->
        </div>
    </div>
    </div>
</div>
<?php include("includes/footer.html"); ?>
</body>

</html>
