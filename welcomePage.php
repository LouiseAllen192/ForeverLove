<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");


    if(isset($_GET['logout']) || isset($_POST['submit_button'])){
        UserServiceMgr::logout();
    }

    $expired=false;

    $errors = [];
    if(isset($_POST['submit_button'])){
       $errors = UserServiceMgr::login($_POST);
        if(isset($errors['expired'])){
            $expired = true;
        }
    }



    ?>
    <title>Welcome Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-welcome.css" rel="stylesheet">
    <script src="bootstrap_js/jquery.js"></script>
    <script src="scripts/login.js"></script>

</head>

<body class="full">
    <?php include("includes/navbarNotLoggedIn.html"); ?>

    <!--Main page content-->

    <div class="row"><br><br></div>
    <div class="row"><br><br></div>
    <div class="row"><br><br></div>
    <div class="row"><br><br></div>
    <div class="row"><div class="col-md-2 col-sm-2 col-xs-8" id="lefttoc"></div>
    <div class="row">
        <div class="col-lg-8 col-md-4 col-sm-6 col-xs-12" id="centretoc">
            <div class="row">
                <div class="col-lg-8 col-md-11 col-sm-4 col-xs-12">
                    <div class="panel panel-primary panel-transparent">
                        <div class="panel-body">

                            <?php
                            if($expired){ ?>
                                <p>The account details you have entered have expired on the
                                    <?php

                                    $username = $_POST['username'];
                                    $uid = ReturnShortcuts::getUserID($username);
                                    $values = ReturnShortcuts::returnAccDetails($uid);

                                    $pieces = explode("-", $values['account_expired']);
                                    echo $pieces[2].'/'.$pieces[1].'/'.$pieces[0];?>
                                    <br><br>
                                    <?php $hrefString = '../ForeverLove/upgradeMembership.php?renew=yes&username='.$username; ?>
                                Please click <a href= "<?php echo $hrefString?>" >here</a> to renew your account</p>

                            <?php }
                            else{
                            ?>

                            <p>Find your Forever Love today! <br><br><br> Sign in to meet your perfect match<br><br>
                                Not already a member? <br>Register now for a FREE 30 day trial<br><br><br><br></p>


                            <a href="#login-box" class="btn btn-info center-block login-window">Sign in</a><br>
                            <a href="registrationPage.php" class="btn btn-info center-block" role="button">Register</a>

                            <div id="login-box" class="login-popup">
                                <a class="close"><img id="close_button" src="includes/pics/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
                                <form method="post" class="signin">
                                    <fieldset class="textbox">
                                        <label class="username" id="username_group">
                                            <span>Username</span>
                                            <input id="username" name="username" value="<?php echo Input::get('username');?>" type="text" autocomplete="on" placeholder="Username">
                                            <span class="<?php if($errors['username'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                            <span class="<?php if($errors['username'] == 'error_login') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_login">Username Not Recognised...</span>
                                            <span class="<?php if($errors['username'] == 'error_banned') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_banned">Account associated with this username is banned. Please contact admin for details</span>
                                        </label>

                                        <label class="password" id="password_group">
                                            <span>Password</span>
                                            <input id="password" name="password" type="password" placeholder="Password">
                                            <span class="<?php if($errors['password'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                            <span class="<?php if($errors['password'] == 'error_login') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_login">Password Incorrect...</span>
                                        </label>

                                        <button class="submit button" name="submit_button" type="submit">Sign in</button>

                                        <p>
                                            <a class="forgot" href="#">Forgot your password?</a>
                                        </p>
                                    </fieldset>
                                </form>
                            </div>


                        <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
