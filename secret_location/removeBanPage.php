<!DOCTYPE html>
<html>
<head>
    <?php
    require_once '../core/init.php';
    include("../includes/metatags.html");
    include("../includes/fonts.html");


    $uid = (isset($_GET['uid'])) ? $_GET['uid'] : 0;
    $username = DB::getInstance()->query("SELECT username FROM registration_details WHERE user_id = '$uid'")->results()[0]->username;

    if(isset($_POST['cancel_button'])){
        header('Location: adminHomePage.php');
        die();
    }
    else if(isset($_POST['remove_ban_button'])){
        DB::getInstance()->query("DELETE FROM banned_users WHERE user_id = '$uid'");
        $removed = true;
    }
    ?>
    <title>Remove Ban Page</title>
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
                <?php
                if(!isset($removed)){
                        ?>
                    <br><br>
                    <hr class="tagline-divider">
                    <h2>
                        <small>
                            <strong>Remove ban for <a href="../profilePage.php?uid=<?php echo $uid;?>" style="color: gold"><?php echo $username;?></a>?</strong>
                        </small>
                    </h2>
                    <hr class="tagline-divider"><br>
                        <div class="row">
                            <div class="col-xs-offset-3">
                                <div class="col-xs-8">
                                    <form class="form-horizontal" method="post">
                                        <input class="btn btn-info center-inline" id="cancel_button" name="cancel_button" type="submit" value="Cancel">
                                        <input class="btn btn-info center-inline" id="remove_ban_button" name="remove_ban_button" type="submit" value="Remove Ban">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                }
                else{?>
                    <br><br><br>
                    <div class= "alert alert-success" role="alert">
                        <p class="close" data-dismiss="alert" aria-label="close"></p>
                        Ban removed successfully
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
