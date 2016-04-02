<!DOCTYPE html>
<html>
<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $uid = $_SESSION['user_id'];

    $results = DB::getInstance()->get('registration_details', ['user_id', '=', $uid])->results()[0];

    if(Input::exists()){
        if(isset($_POST['old_password']) && password_verify($_POST['old_password'], $results->password)){
            $_POST['old_password_confirm'] = $_POST['old_password'];
            $errors = UserServiceMgr::updatePassword($_POST);
        }
        else{
            $errors['old_password'] = 'error_wrong_password';
        }
    }
    ?>

    <title>Update Password</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <script src="bootstrap_js/jquery.js"></script>
    <script src="scripts/passwordValidation.js"></script>

</head>

<body class="full">
<?php include("includes/navbar.php"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong>Update Password</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                    <br><br>

                    <?php
                    if(Input::exists()){
                    if(!$errors){?>
                <div class= "alert alert-success" role="alert">
                    <a href="homePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Password Details updated successfully
                </div>
                <?php
                }
                else{?>
                    <div class="alert alert-danger">
                        <a href="settingsPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error</strong> - Password update was unsuccessful
                    </div>
                    <?php
                }
                }
                ?>

                <form id="reg_form" class="form-horizontal" role="form" method="post">
                    <fieldset>



                        <div class="form-group" id="old_password_group">
                            <label for="old_password" class="col-md-4 col-sm-5 control-label"><b>Enter old password:</b></label>
                            <div class="col-md-8 col-sm-7">
                                <input type="password" class="form-control" maxlength="32" id="old_password" name="old_password" value="">
                            </div>
                            <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                <span class="<?php if($errors['old_password'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                <span class="<?php if($errors['old_password'] == 'error_wrong_password') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_wrong_password">Wrong Password...</span>
                            </div>
                        </div>

                        <div class="form-group" id="old_password_confirm_group">
                            <label for="old_password_confirm" class="col-md-4 col-sm-5 control-label"><b>Confirm old password:</b></label>
                            <div class="col-md-8 col-sm-7">
                                <input type="password" class="form-control" maxlength="32" id="old_password_confirm" name="old_password_confirm" value="">
                            </div>
                            <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                <span class="<?php if($errors['old_password_confirm'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                <span class="<?php if($errors['old_password_confirm'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_wrong_password">Passwords do not match...</span>
                            </div>
                        </div>

                        <div class="form-group" id="new_password_group">
                            <label for="new_password" class="col-md-4 col-sm-5 control-label"><b>Enter new password:</b></label>
                            <div class="col-md-8 col-sm-7">
                                <input type="password" class="form-control" maxlength="32" id="new_password" name="new_password" value="">
                            </div>
                            <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                <span class="<?php if($errors['new_password'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                <span class="<?php if($errors['new_password'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, 6 - 32 characters(a-zA-Z0-9_-) only...</span>
                            </div>
                        </div>

                        <div class="form-group" id="new_password_confirm_group">
                            <label for="new_password_confirm" class="col-md-4 col-sm-5 control-label"><b>Confirm new password:</b></label>
                            <div class="col-md-8 col-sm-7">
                                <input type="password" class="form-control" maxlength="32" id="new_password_confirm" name="new_password_confirm" value="">
                            </div>
                            <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                <span class="<?php if($errors['new_password_confirm'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                <span class="<?php if($errors['new_password_confirm'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Passwords do not match...</span>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <input class="btn btn-info center-inline" id="continue_button" type="submit" value="Apply Changes">
                </form>

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