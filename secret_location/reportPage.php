<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<head>
    <?php
    require_once '../core/init.php';
    include("../includes/metatags.html");
    include("../includes/fonts.html");

    $report_id = $_GET['report_id'];
    $db = DB::getInstance();
    if(isset($_POST['resolved_button'])){
        $db->update('banned_reports', 'report_id = '.$report_id, ['resolved' => '1']);
    }
    else if(isset($_POST['unresolved_button'])){
        $db->update('banned_reports', 'report_id = '.$report_id, ['resolved' => '0']);
    }
    $report = $db->get('banned_reports', ['report_id', '=', $report_id])->results()[0];
    $priorities = SearchServiceMgr::getChoices('priority');
    $reporter = UserServiceMgr::getUsername($report->reporter_id);
    $reportee = UserServiceMgr::getUsername($report->reportee_id);

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
            <div class="col-lg-12">
                <br><br>
                <hr class="tagline-divider">
                <h2 class="text-center">
                    <small>
                        <strong>Report id: <?php echo $report->report_id;?></strong>
                    </small>
                </h2>
                <hr class="tagline-divider"><br>


                <div class="row">
                    <div class="col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center">
                                Content
                            </div>
                            <div class="panel-body">
                                <div  style="height: 350px;overflow: auto;">
                                    <p><?php echo nl2br($report->content);?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center">
                                Details
                            </div>
                            <div class="panel-body">
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-center">
                                        Status: <?php if($report->resolved){echo 'Resolved';}else{echo 'Unresolved';}?>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-center">
                                        Priority: <?php echo $db->query("SELECT choice FROM priority WHERE id = '$report->priority'")->results()[0]->choice;?>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-center">
                                        Reporter: <a href="../profilePage.php?uid=<?php echo $report->reporter_id;?>" style="color: gold"><?php echo $reporter;?></a>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-center">
                                        Reportee: <a href="../profilePage.php?uid=<?php echo $report->reportee_id;?>" style="color: gold"><?php echo $reportee;?></a>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-center">
                                        <a href="banUserPage.php?uid=<?php echo $report->reportee_id;?>&report_id=<?php echo $report_id;?>" style="color: gold"><?php echo 'Ban '.$reportee;?></a>
                                    </div>
                                </div>
                                <?php
                                    if($report->view_conversation == '1' && $report->conversation_id != '0')
                                    {
                                        echo "<div class=\"panel panel-primary\">
                                            <div class=\"panel-heading text-center\">
                                            <form name = \"form\" action = \"../conversationPage.php?$report->conversation_id\" method = \"post\">
                                                <input type = \"hidden\" name = \"permission\" value = \"1\">
                                                <input type = \"hidden\" name = \"report_id\" value = $report_id>
                                                <a href=\"#\"  style=\"color: gold\" onclick=\"document.forms['form'].submit();\">View Conversation</div></a>
                                            </form>
                                            </div>
                                        </div>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-offset-4">
                            <form class="form-horizontal" method="post">
                                <?php
                                if($report->resolved){?>
                                    <input class="btn btn-info center-inline" id="unresolved_button" name="unresolved_button" type="submit" value="Mark Unresolved">
                                    <?php
                                }
                                else {?>
                                    <input class="btn btn-info center-inline" id="resolved_button" name="resolved_button" type="submit" value="Mark Resolved">
                                    <?php
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>

                <a href="../secret_location/adminHomePage.php" class="btn btn-info pull-left" role="button"><span class="glyphicon glyphicon-chevron-left"></span> Back To Menu</a>

            </div>
         </div>
    </div>
</div>
<?php include("../includes/footer.html"); ?>
</body>

</html>
