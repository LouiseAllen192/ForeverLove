<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include($_SERVER['DOCUMENT_ROOT'].'/classes/UserServiceMgr.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/ReturnShortcuts.php');


    $uid = 1;//$_SESSION['user_id'];
    $acc = "";
    $length;
    if(!empty($_POST) && !isset($_POST['accType'])) {
        $errors = UserServiceMgr::errorsExistInCardDetails();
    }

    ?>

    <title>Select Account type</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
    <script src="bootstrap_js/jquery.js"></script>
    <script src="scripts/registrationValidation.js"></script>
    <?php include("includes/fonts.html"); ?>

</head>

<body class="full">
<?php include("includes/navbar.html"); ?>

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

                <p>Here at ForeverLove we want to give everyone the best possible chance at happiness. <br>
                    That's why we give all our members a 30day trial for FREE. <br><br>Find a love that will last a lifetime.<br>Continue your sign up here...</p>
                <br>

                <?php
                if(empty($_POST)){?>
                    <div class = "panel panel-default">
                        <div class = "panel-body">
                            <form role ="form" class="form-inline" action="registerAccountTypePage.php" method="post" id="accTypeForm">
                                <fieldset class="form-group">
                                    <label for="accountType">Please select which type of account you would like:</label>
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
                if(!empty($_POST) && isset($_POST['accType']) ) {

                    if ($_POST['accType'] == "free") {
                        $acc = "Free 30 day trial";
                        $length = 30;
                    }
                    else if ($_POST['accType'] == "premium3") {
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

                    if ($_POST['accType'] == "free") {
                        $successRegisterFree = UserServiceMgr::registerAccountType($uid, 30);
                        if($successRegisterFree){?>
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
                        else{?>
                            <div class="alert alert-danger">
                                <a href="registerAccountTypePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <p><strong>Something went wrong</strong> - Account details registration was unsuccessful. Please try again</p>
                            </div>
                        <?php
                        }
                    } else {?>

                        <div class= "alert alert-info" role="alert" id="selectedMessage">
                            <p>You have chosen a <?php echo $acc;?> account.</p>
                        </div><br><br><p>You are on your way to having unlimited access to all of our features.<br></p><br>
                            <div class = "panel panel-default">
                                <div class = "panel-body">
                                    <form id="regDetails_form" class="form-horizontal" role="form" method="post">
                                        <fieldset>
                                            <label>Please enter your payment information here:<br><br></label>
                                        </fieldset>
                                            <fieldset>
                                                <div class="form-group" id="name_on_card_group">
                                                    <label for="name_on_card" class="col-md-4 col-sm-5 control-label"><b>Name on Card</b></label>
                                                    <div class="col-md-8 col-sm-7">
                                                        <input type="text" class="form-control" id="name_on_card" name="name_on_card" maxlength="128" value="<?php echo Input::get('name_on_card');?>">
                                                    </div>
                                                    <p class="col-md-4 col-sm-5"></p>
                                                    <span class="<?php if($errors['name_on_card'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                                    <span class="<?php if($errors['name_on_card'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, e.g. John Doe</span>
                                                </div>

                                                <div class="form-group" id="type_group">
                                                    <label for="type" class="col-md-4 col-sm-5 control-label"><b>Card type</b></label>
                                                    <div class="col-md-8 col-sm-7">
                                                        <select name="cardType" id="cardType" class="form-control">
                                                               <option value="Visa"> Visa</option>
                                                               <option value="Mastercard"> Mastercard</option>
                                                               <option value="Laser"> Laser</option>
                                                               <option value="Maestro"> Maestro</option>
                                                        </select>
                                                    </div>
                                                    <p class="col-md-4 col-sm-5"></p>
                                                </div>

                                                <div class="form-group" id="cardnum_group">
                                                    <label for="cardnum" class="col-md-4 col-sm-5 control-label"><b>Card number</b></label>
                                                    <div class="col-md-8 col-sm-7">
                                                        <input type="text" class="form-control" id="cardnum" name="cardnum" maxlength="128" value="">
                                                    </div>
                                                    <p class="col-md-4 col-sm-5"></p>
                                                    <span class="<?php if($errors['cardnum'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                                    <span class="<?php if($errors['cardnum'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, must be 13 or 16 digits</span>
                                                </div>

                                                <div class="form-group" id="expiry_group">
                                                    <label for="expiry" class="col-md-4 col-sm-5 control-label"><b>Expiry Date</b></label>
                                                    <div class="col-md-8 col-sm-7">
                                                        <input type="text" class="form-control" id="expiry" name="expiry" maxlength="128" value="">
                                                    </div>
                                                    <p class="col-md-4 col-sm-5"></p>
                                                    <span class="<?php if($errors['expiry'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                                    <span class="<?php if($errors['expiry'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, MM/YY </span>
                                                </div>

                                                <div class="form-group" id="cvv_group">
                                                    <label for="cvv" class="col-md-4 col-sm-5 control-label"><b>Security code</b></label>
                                                    <div class="col-md-8 col-sm-7">
                                                        <input type="text" class="form-control" id="cvv" name="cvv" maxlength="128" value="">
                                                    </div>
                                                    <p class="col-md-4 col-sm-5"></p>
                                                    <span class="<?php if($errors['cvv'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                                    <span class="<?php if($errors['cvv'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, Must be 3 digits </span>
                                                </div>

                                                <div class="form-group" id="address_group">
                                                    <label for="address" class="col-md-4 col-sm-5 control-label"><b>Billing address</b></label>
                                                    <div class="col-md-8 col-sm-7">
                                                        <textarea type="text" class="form-control" name="address" id= "address" rows="3" maxlength="128" value="<?php echo Input::get('address');?>"></textarea>
                                                    </div>
                                                    <p class="col-md-4 col-sm-5"></p>
                                                    <span class="<?php if($errors['address'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                                </div>

                                                <div class="form-group" id="address_group">
                                                    <div class="col-md-8 col-sm-7">
                                                        <input class="btn btn-info center-inline" id=payment_submit_button" name= "'.$length.'" type="submit" value="Submit">
                                                    </div>
                                                    <p class="col-md-4 col-sm-5"></p>
                                                    </div>
                                        </fieldset>
                                     </form>
                                </div>
                            </div>
                        <?php
                    }
                }
                if(isset($_POST['cvv'])){
                    $length;
                    foreach($_POST as $key=>$value){
                        if($value == "Submit"){
                            $length = $key;
                        }
                    }

                    $successValidateCard = UserServiceMgr::validateCreditCard($uid, $_POST);
                    if(!$successValidateCard){?>
                        <div class="alert alert-danger">
                            <a href="registerAccountTypePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <p><strong>Something went wrong</strong> - The Credit Card details you entered are not valid.</p>
                        </div>
                    <?php
                    }
                    else{
                        $successRegister = UserServiceMgr::registerAccountType($uid, $length);
                        if(!$successRegister){?>
                            <div class="alert alert-danger">
                                <a href="registerAccountTypePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <p><strong>Something went wrong</strong> - Account details registration was unsuccessful. Please try again</p>
                            </div>
                        <?php
                        }
                        else{?>
                            <div class="alert alert-success">
                                <a href="registerAccountTypePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <p><strong>Card Details accepted</strong> <br><br> Account details registration was successful.<br>
                                Please continue with your registration</p>
                                <br><br><br>
                                <a href="updatePreferencesPage.php" class="btn btn-info center-inline" role="button">Continue</a>
                            </div>
                        <?php
                        }
                    }

                }?>

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
