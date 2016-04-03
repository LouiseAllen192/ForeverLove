<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");

    $renew=false;
    $finished=false;

    if(isset($_GET['renew'])){
        $renew=true;
        $userN = $_GET['username'];
    }
    if  (isset($_POST['renew']) ){
        $renew=true;
        $userN = $_POST['username'];
    }

    if(!$renew) {
        $uid = $_SESSION['user_id'];
    }
    else{
        $uid = ReturnShortcuts::getUserID($userN);
    }


    $errors = UserServiceMgr::validateCreditCardDetails($_POST);

    if(isset($_POST['security']) && !($errors)){
        if(UserServiceMgr::validateCreditCard($uid, $_POST)){
            $finished=true;
            $length = $_POST['length'];
            $success = UserServiceMgr::registerUpgradeAccountType($uid, $length);
        }
        else{
            ?>
            <div class="alert alert-danger">
                <a href="registerAccountTypePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p><strong>Something went wrong</strong> - The Credit Card details you entered are not valid.</p>
            </div>
        <?php }
    }
    ?>




    <title>View Membership status</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <script src="bootstrap_js/jquery.js"></script>
    <script src="scripts/creditCardValidation.js"></script>

    <?php include("includes/fonts.html"); ?>
    <?php


    ?>

</head>

<body class="full">

<?php
if($renew){
    include("includes/navbarNotLoggedIn.html");
}
else{
    include("includes/navbar.php");
}
 ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong><?php if($renew){echo 'Renew';} else{echo 'Upgrade';}?> Membership status</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                    <br><br>

                    <?php

                    if($finished){ ?>
                        <div class="alert alert-success">
                            <a href="registerAccountTypePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <p><strong>Success</strong> - You <?php if($renew){ echo 'have successfully renewed your account';} else{ echo 'are now a Premium user. ';}?><br> You can enjoy full access to our site for <?php echo $length;?> months.</p>
                        </div>
                        <?php if (!$renew){?>
                         <br><br><a href="viewMembershipStatusPage.php" class="btn btn-info center-inline" role="button">Return to 'View Membership' Page</a>
                        <?php } else { ?>
                        <br><br><a href="welcomePage.php" class="btn btn-info center-inline" role="button">Return to welcome Page</a>
                        <?php   }
                    }

                    ?>


                <?php if(empty($_POST)){

                if(!$renew){ ?>
                    <p>You have chosen to upgrade your account from a Free membership to a Premium membership. <br>
                        Premium members have full access to all our websites features including Blind Date and Suggestions<br></p>
                <?php }
                else{ ?>
                    <p>
                        You have chosen to renew your account with us. Continue your search for love with us for a further 3, 6 or 9 months.<br>
                    </p>

                <?php }
                    ?>



                    <br><br>

                    <div class = "panel panel-default">
                        <div class = "panel-body">
                            <form role ="form" class="form-inline" action="upgradeMembership.php" method="post" id="accTypeForm">
                                <fieldset class="form-group">
                                    <label for="accountType">Please select which type of Premium account you would like:</label>
                                    <select name="accType" id="accType" class="form-control">
                                        <option value="premium3">Premiuim Account - 3 months</option>
                                        <option value="premium6">Premiuim Account - 6 months</option>
                                        <option value="premium12">Premiuim Account - 12 months</option>
                                    </select>
                                </fieldset>
                                <br><br>
                                <input type="hidden" name="renew" value="yes">
                                <input type="hidden" name="username" value="<?php echo $userN?>">
                                <input type="submit" name="Send" id="Send" class="btn btn-primary" Value="Select">
                            </form>
                        </div>
                    </div>
                    <?php
                }


                if(!empty($_POST) && isset($_POST['accType']) ) {

                    if ($_POST['accType'] == "premium3") {
                        $acc = "3 month Premium";
                        $length = 3;
                    }
                    else if ($_POST['accType'] == "premium6") {
                        $acc = "6 month Premium";
                        $length = 6;
                    }
                    else if ($_POST['accType'] == "premium12") {
                        $acc = "12 month Premium";
                        $length = 12;
                    }

                    ?>

                        <div class= "alert alert-info" role="alert" id="selectedMessage">
                            <p>You have chosen a <?php echo $acc;?> account.</p>
                        </div><br><br><p>You are on your way to having unlimited access to all of our features.<br></p><br>
                        <div class = "panel panel-default">
                            <div class = "panel-body">

                                <!---------------------------------------------------------------------------------------------------------------------------------------->

                                <form id="regDetails_form" class="form-horizontal" role="form" method="post">
                                    <fieldset>
                                        <label>Please enter your payment information here:<br><br></label>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group" id="fullname_group">
                                            <label for="fullname" class="col-md-4 col-sm-5 control-label"><b>Name on Card</b></label>
                                            <div class="col-md-8 col-sm-7">
                                                <input type="text" class="form-control" id="fullname" name="fullname" maxlength="128" value="<?php echo Input::get('fullname');?>">
                                            </div>
                                            <p class="col-md-4 col-sm-5"></p>
                                            <span class="<?php if($errors['fullname'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                            <span class="<?php if($errors['fullname'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, e.g. John Doe</span>
                                        </div>

                                        <div class="form-group" id="ccNumber_group">
                                            <label for="ccNumber" class="col-md-4 col-sm-5 control-label"><b>Card number</b></label>
                                            <div class="col-md-8 col-sm-7">
                                                <input type="text" class="form-control" id="ccNumber" name="ccNumber" maxlength="128" value="<?php echo Input::get('ccNumber');?>">
                                            </div>
                                            <p class="col-md-4 col-sm-5"></p>
                                            <span class="<?php if($errors['ccNumber'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                            <span class="<?php if($errors['ccNumber'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, must be 16 digits</span>
                                        </div>

                                        <div class="form-group" id="month_group">
                                            <label for="month" class="col-md-4 col-sm-5 control-label"><b>Expiry Month</b></label>
                                            <div class="col-md-8 col-sm-7">
                                                <input type="text" class="form-control" id="month" name="month" maxlength="128" value="<?php echo Input::get('month');?>">
                                            </div>
                                            <p class="col-md-4 col-sm-5"></p>
                                            <span class="<?php if($errors['month'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                            <span class="<?php if($errors['month'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid month, format MM </span>
                                        </div>

                                        <div class="form-group" id="year_group">
                                            <label for="year" class="col-md-4 col-sm-5 control-label"><b>Expiry Year</b></label>
                                            <div class="col-md-8 col-sm-7">
                                                <input type="text" class="form-control" id="year" name="year" maxlength="128" value="<?php echo Input::get('year');?>">
                                            </div>
                                            <p class="col-md-4 col-sm-5"></p>
                                            <span class="<?php if($errors['year'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                            <span class="<?php if($errors['year'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid year, format YY </span>
                                            <span class="<?php if($errors['year'] == 'error_valid_date') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Must be a valid date</span>
                                        </div>

                                        <div class="form-group" id="security_group">
                                            <label for="security" class="col-md-4 col-sm-5 control-label"><b>Security code</b></label>
                                            <div class="col-md-8 col-sm-7">
                                                <input type="text" class="form-control" id="security" name="security" maxlength="128" value="<?php echo Input::get('security');?>">
                                            </div>
                                            <p class="col-md-4 col-sm-5"></p>
                                            <span class="<?php if($errors['security'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                            <span class="<?php if($errors['security'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, Must be 3 digits </span>
                                        </div>

                                        <div class="form-group" id="hidden_group">
                                            <input type="hidden" name="length" value="<?php echo $length?>">
                                        </div>

                                    </fieldset>
                                    <br>
                                    <input type="hidden" name="renew" value="yes">
                                    <input type="hidden" name="username" value="<?php echo $userN?>">
                                    <input class="btn btn-info center-inline" id=payment_submit_button" name= "submit" type="submit" value="Submit">
                                </form>

                                <!------------------------------------------------------------------------------------------------------------------------------------------>

                            </div>
                        </div>
                        <?php

                } ?>

                <br><br>
                <br><br>
                <br><br>
                </p>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>