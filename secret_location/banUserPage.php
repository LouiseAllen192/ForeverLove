<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<head>
    <?php
    session_start();// DELETE
    $_SESSION['permissions'] = 'admin';// DELETE
    require_once '../core/init.php';
    include("../includes/metatags.html");
    include("../includes/fonts.html");

    $uid = $_GET['uid'];
    $results = DB::getInstance()->query("SELECT username,first_name,last_name,email FROM registration_details WHERE user_id = '$uid'")->results()[0];
    $ban_lengths = SearchServiceMgr::getChoices('ban_length');
    $banSuccessful = false;
    if(isset($_POST['apply_ban']) && isset($_POST['ban_length'])){
        $banSuccessful = AdminServiceMgr::banUser($uid, $_GET['report_id'], $_POST['ban_length']);
        //mail($results->email, 'Account Suspended', $_POST['message']);
    }
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
                        <strong>Apply Ban to: <a href="../profilePage.php?uid=<?php echo $uid;?>" style="color: gold"><?php echo $results->username;?></a></strong>
                    </small>
                </h2>
                <?php
                if(isset($_POST['apply_ban'])){
                    if($banSuccessful){?>
                        <div class= "alert alert-success text-center" role="alert">
                            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            Successfully banned <?php echo $results->username;?>
                        </div>
                        <?php
                    }
                    else{?>
                        <div class="alert alert-danger text-center">
                            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error</strong> - Ban submission was unsuccessful
                        </div>
                        <?php
                    }
                }
                ?>
                <hr class="tagline-divider"><br>
                <div class="row">
                    <form class="col-xs-12" method="post" role="form">
                        <div class="row">
                            <div class="col-md-offset-2 col-xs-offset-1">
                                <div class="row">
                                    <div class="col-md-offset-3 col-xs-offset-3">
                                        <div class="col-md-5 col-xs-6">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    Ban Length
                                                </div>
                                                <div class="panel-body">
                                                    <select class="form-control" name="ban_length">
                                                        <option disabled selected>Choose Ban Length</option>
                                                        <?php
                                                        foreach($ban_lengths as $id => $choice){?>
                                                            <option value="<?php echo $id;?>"><?php echo $choice;?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-10">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading text-center">
                                                Email reason to <?php echo $results->username;?>
                                            </div>
                                            <div class="panel-body">
                                                <div  style="height: 250px;overflow: auto;">
                                                    <textarea class="form-control" id="message" name="message" style="height: 250px;overflow: auto;">Dear <?php echo $results->first_name.' '.$results->last_name.',';?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            <div class="text-center">
                                <input class="btn btn-info center-inline" id="apply_ban" name="apply_ban" type="submit" value="Apply Ban">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("../includes/footer.html"); ?>
</body>

</html>
