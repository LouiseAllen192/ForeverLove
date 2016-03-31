<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<head>
    <?php
    session_start();// DELETE
    $_SESSION['permissions'] = 'admin';// DELETE
    require_once '../core/init.php';
    include("../includes/metatags.html");
    include("../includes/fonts.html");

    $uid = 5;//$_GET['uid'];
    $username = UserServiceMgr::getUsername($uid);
    $db = DB::getInstance();
    $name = $db->query("SELECT first_name,last_name FROM registration_details WHERE user_id = '$uid'")->results()[0];
    $ban_lengths = SearchServiceMgr::getChoices('ban_length');
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
                        <strong>Apply Ban to: <a href="../profilePage.php?uid=<?php echo $uid;?>" style="color: gold"><?php echo $username;?></a></strong>
                    </small>
                </h2>
                <hr class="tagline-divider"><br>
                <div class="row col-xs-offset-3">
                    <div class="row">
                        <div class="col-xs-offset-2 col-xs-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Ban Length
                                </div>
                                <div class="panel-body">
                                    <select class="form-control" name="ban_length">
                                        <option disabled selected>Ban <?php echo $username;?></option>
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
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="panel panel-primary">
                                <div class="panel-heading text-center">
                                    Email reason to <?php echo $username;?>
                                </div>
                                <div class="panel-body">
                                    <div  style="height: 250px;overflow: auto;">
                                        <textarea class="form-control" id="email" name="email" style="height: 250px;overflow: auto;">Dear <?php echo $name->first_name.' '.$name->last_name.',';?></textarea>
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
        </div>
    </div>
</div>
<?php include("../includes/footer.html"); ?>
</body>

</html>
