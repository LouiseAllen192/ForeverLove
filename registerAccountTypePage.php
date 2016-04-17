<!DOCTYPE html>
<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $uid = $_SESSION['user_id'];

        if(isset($_GET['reg'])){
            if (!file_exists(dirname(realpath("registerAccountTypePage.php"))."\userImageUploads\user".$uid)) {
                mkdir(dirname(realpath("registerAccountTypePage.php"))."\userImageUploads\user".$uid, 0700);
            }
        }


    $errors = array();
    $errorMsg = false;

    if(isset($_POST['month']) && isset($_POST['year'])) {
        $dateMonth = $_POST['month'];
        $dateYear = $_POST['year'];
        $now = new  DateTime('now');
        $curMonth = $now->format('m');
        $curYear = $now->format('y');

        if($curYear<$dateYear){
            $errors = UserServiceMgr::validateCreditCardDetails($_POST);
        }
        else if($curYear == $dateYear && $dateMonth > $curMonth){
            $errors = UserServiceMgr::validateCreditCardDetails($_POST);
        }
        else{
            $errors['year'] = 'error_valid_date';
        }
    }

    if(!empty($_POST) && isset($_POST['payment_submit_button']) && !($errors)){
        echo 'IN HERE';
        foreach($_POST as $k=>$v){
            echo '$k'.'----'.$v.'<br>';
        }
        if(UserServiceMgr::validateCreditCard($_POST) == 1){
            $length = $_POST['length'];
            UserServiceMgr::registerUpgradeAccountType($uid, $length);
            header('Location: updatePreferencesPage.php');
            die();
        }
        else{ $errorMsg = true;}
    } ?>

    <title>Select Account type</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <script src="bootstrap_js/jquery.js"></script>
    <script src="scripts/creditCardValidation.js"></script>

</head>

<body class="full">

<?php
include("includes/navbarRegistration.php"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong>Select Account type</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <br>

                <?php if(empty($_POST)){ ?>
                <br><p>Here at ForeverLove we want to give everyone the best possible chance at happiness. <br>
                    That's why we give all our members a 30 day trial for FREE. <br><br>Find a love that will last a lifetime.<br>Continue your sign up here...</p>
                <br><br>
                <?php }?>

                <?php

                if($errorMsg){ ?>
                    <div class="alert alert-danger">
                        <a href="registerAccountTypePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p><strong>Something went wrong</strong> - The Credit Card details you entered are not valid.</p>
                    </div>

                <?php }

                if(empty($_POST)){
                    ?>
                    <div class = "panel panel-default">
                        <div class = "panel-body">
                            <form role ="form" class="form-inline" action="registerAccountTypePage.php" method="post" id="accTypeForm">
                                <fieldset class="form-group">
                                    <label for="accountType">Please select which type of account you would like:</label><br>
                                    <select name="accType" id="accType" class="form-control">
                                        <option value="free">30 day Free Trial</option>
                                        <option value="premium3">Premiuim Account - 3 months</option>
                                        <option value="premium6">Premiuim Account - 6 months</option>
                                        <option value="premium12">Premiuim Account - 12 months</option>
                                    </select>
                                </fieldset>
                                <br><br>
                                <input type="submit" name="Send" id="Send" class="btn btn-primary" Value="Select">
                            </form>
                        </div>
                </div>
                    <?php
                }
                if(!empty($_POST) && (isset($_POST['accType']) || !isset($_POST['payment_submit_button']))) {
                    $accType = $_POST['accType'];

                    if ($accType == "free") {
                        $acc = "Free 30 day trial";
                        $length = 30;
                    }
                    else if ($accType == "premium3") {
                        $acc = "3 month Premium";
                        $length = 3;
                    }
                    else if ($accType == "premium6") {
                        $acc = "6 month Premium";
                        $length = 6;
                    }
                    else if ($accType == "premium12") {
                        $acc = "12 month Premium";
                        $length = 12;
                    }

                    if ($_POST['accType'] == "free") {
                        $successRegisterFree = UserServiceMgr::registerUpgradeAccountType($uid, 30);
                        if($successRegisterFree){ ?>
                            <div class= "alert alert-info" role="alert" id="selectedMessage">
                                <a href="homePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <p>You have chosen a <?php echo $acc;?> account.</p>
                            </div><br><br>
                            <p>Enjoy your 30 day free trial.<br><br>
                                Please upgrade to a Premium account to gain unlimited access to all of our websites features.<br>
                                This can be done in the Settings option.
                            </p>
                                <br><br><a href="updatePreferencesPage.php" class="btn btn-info" role="button">Continue Registration</a>
                        <?php
                        }
                        else{
                            ?>
                            <div class="alert alert-danger">
                                <a href="registerAccountTypePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <p><strong>Something went wrong</strong> - Account details registration was unsuccessful. Please try again</p>
                            </div>
                        <?php
                        }
                    }
                    else
                    {
                        if(isset($_POST['acc'])) $acc = $_POST['acc']; ?>

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
                                                    <input type="hidden" name="acc" value="<?php echo $acc?>">
                                                    <input type="hidden" name="accType" value="<?php echo $accType?>">
                                                </div>

                                        </fieldset>
                                        <br>
                                        <input class="btn btn-info center-inline" id=payment_submit_button" name= "payment_submit_button" type="submit" value="Submit">
                                    </form>

                                <!------------------------------------------------------------------------------------------------------------------------------------------>

                                </div>
                            </div>
                        <?php
                    }
                } ?>

                <br><br>
                <br><br>
                </p>
            </div>

            <?php if($browser == 'IE'){ ?>
                <br><br><br><br><br><br><br><br>
            <?php } ?>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>
