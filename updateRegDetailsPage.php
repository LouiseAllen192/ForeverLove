<!DOCTYPE html>
<html>
<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $me = $_SESSION['user_id'];


    $db = DB::getInstance();
    $results = $db->get('registration_details', ['user_id', '=', $me])->results()[0];
    $dob = $db->query("SELECT date_of_birth FROM preference_details WHERE user_id = $me")->results()[0];

    if(Input::exists()){
        if(isset($_POST['password']) && password_verify($_POST['password'], $results->password)){
            $_POST['confirm_password'] = $_POST['password'];
            $errors = UserServiceMgr::registerUpdateAccount($_POST, true);
        }
        else{
            $errors['password'] = 'error_wrong_password';
        }
    }
    ?>

    <title>Update Account Details</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <script src="bootstrap_js/jquery.js"></script>
    <script src="scripts/registrationValidation.js"></script>

</head>

<body class="full">
<?php include("includes/navbar.php"); ?>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br>
                <hr class="tagline-divider">
                <h2>
                    <small>
                        <strong>Update Account Details</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                <br>

                    <?php
                    if(Input::exists()){
                        if(!$errors){?>
                            <div class= "alert alert-success" role="alert">
                                <a href="homePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Account Details updated successfully
                            </div>
                            <?php
                        }
                        else{?>
                            <div class="alert alert-danger">
                                <a href="settingsPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Error</strong> - Account Details update was unsuccessful
                            </div>
                                <?php
                        }
                    }
                    ?>

                    <form id="reg_form" class="form-horizontal" role="form" method="post">
                        <fieldset>
                            <div class="form-group" id="email_group">
                                <label for="email" class="col-md-4 col-sm-5 control-label"><b>Email</b></label>
                                <div class="col-md-8 col-sm-7">
                                    <input type="email" class="form-control" id="email" name="email" maxlength="128" value="<?php echo $results->email;?>">
                                </div>
                                <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                    <span class="<?php if($errors['email'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['email'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, e.g. kevin@example.com</span>
                                    <span class="<?php if($errors['email'] == 'error_unique') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_unique">Email address is already registered...</span>
                                </div>
                            </div>

                            <div class="form-group" id="confirm_email_group">
                                <label for="confirm_email" class="col-md-4 col-sm-5 control-label"><b>Confirm Email</b></label>
                                <div class="col-md-8 col-sm-7">
                                    <input type="email" class="form-control" id="confirm_email" name="confirm_email" maxlength="128" value="<?php echo $results->email;?>">
                                </div>
                                <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                    <span class="<?php if($errors['confirm_email'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['confirm_email'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Email addresses do not match...</span>
                                </div>
                            </div>

                            <div class="form-group" id="username_group">
                                <label for="username" class="col-md-4 col-sm-5 control-label"><b>Username</b></label>
                                <div class="col-md-8 col-sm-7">
                                    <input type="text" class="form-control" id="username" name="username" maxlength="32" value="<?php echo $results->username;?>">
                                </div>
                                <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                    <span class="<?php if($errors['username'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['username'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid username, 3 - 32 characters(a-zA-Z0-9_-) only...</span>
                                    <span class="<?php if($errors['username'] == 'error_unique') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_unique">Username already in use...</span>
                                </div>
                            </div>

                            <div class="form-group" id="first_name_group">
                                <label for="first_name" class="col-md-4 col-sm-5 control-label"><b>First Name</b></label>
                                <div class="col-md-8 col-sm-7">
                                    <input type="text" class="form-control" id="first_name" name="first_name" maxlength="32" value="<?php echo $results->first_name;?>" autocomplete="on">
                                </div>
                                <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                    <span class="<?php if($errors['first_name'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['first_name'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, 2 - 32 characters(a-zA-Z) only...</span>
                                </div>
                            </div>

                            <div class="form-group" id="last_name_group">
                                <label for="last_name" class="col-md-4 col-sm-5 control-label"><b>Last Name</b></label>
                                <div class="col-md-8 col-sm-7">
                                    <input type="text" class="form-control" id="last_name" name="last_name" maxlength="32" value="<?php echo $results->last_name;?>" autocomplete="on">
                                </div>
                                <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                    <span class="<?php if($errors['last_name'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['last_name'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, 2 - 32 characters(a-zA-Z'-) only...</span>
                                </div>
                            </div>

                            <div class="form-group" id="dob_group">
                                <label for="dob" class="col-md-4 col-sm-5 control-label"><b>Date Of Birth</b></label>
                                <div class="col-md-8 col-sm-7">
                                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob->date_of_birth;?>">
                                </div>
                                <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                    <span class="<?php if($errors['dob'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['dob'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Over 18's Only...</span>
                                </div>
                            </div>

                            <div class="form-group" id="password_group">
                                <label for="password" class="col-md-4 col-sm-5 control-label"><b>Enter Password to confirm changes:</b></label>
                                <div class="col-md-8 col-sm-7">
                                    <input type="password" class="form-control" maxlength="32" id="password" name="password" value="">
                                </div>
                                <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                    <span class="<?php if($errors['password'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['password'] == 'error_wrong_password') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_wrong_password">Wrong Password...</span>
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

            <a href="settingsPage.php" class="btn btn-info" role="button"><span class="glyphicon glyphicon-chevron-left"></span> Back To Settings Page</a>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>