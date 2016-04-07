<!DOCTYPE html>
<html>

<head>
    <?php
    $GLOBALS['adminLogin'] = true;
    require_once '../core/init.php';
    include("../includes/metatags.html");
    include("../includes/fonts.html");

    $successfulLogin = false;
    $errors = [];
    if(isset($_POST['login_button'])){
        $errors = AdminServiceMgr::login($_POST);
    }

    if(isset($_GET['logout'])){
        AdminServiceMgr::logout();
    }

    ?>
    <title>Admin Login Page</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom-admin.css" rel="stylesheet">

</head>

<body class="full">
<!--Main page content-->

<div class="container">
    <div class="row">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong>Admin Login</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <br>

                <form class="form-horizontal" role="form" method="post">
                    <fieldset>
                        <div class="form-group" id="email_group">
                            <label for="email" class="col-md-4 col-sm-5 control-label"><b>Email:</b></label>
                            <div class="col-md-8 col-sm-7">
                                <input type="email" class="form-control" id="email" name="email" maxlength="128" value="<?php echo Input::get('email');?>">
                            </div>
                            <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                <span class="<?php if($errors['email'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                <span class="<?php if($errors['email'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, e.g. kevin@example.com</span>
                                <span class="<?php if($errors['email'] == 'error_login') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Email address not recognised...</span>
                            </div>
                        </div>
                        <div class="form-group" id="password_group">
                            <label for="password" class="col-md-4 col-sm-5 control-label"><b>Password:</b></label>
                            <div class="col-md-8 col-sm-7">
                                <input type="password" class="form-control" maxlength="32" id="password" name="password" value="">
                            </div>
                            <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                <span class="<?php if($errors['password'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                <span class="<?php if($errors['password'] == 'error_login') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Password Incorrect...</span>
                            </div>
                        </div>
                        <input class="btn btn-info center-inline" id="login_button" name="login_button" type="submit" value="Login">
                    </fieldset>
                </form>

            </div>
    </div>
</div>
<?php include("../includes/footer.html"); ?>
</body>

</html>

