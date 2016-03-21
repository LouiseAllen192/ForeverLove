<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>Update Account Details</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="scripts/accountType.js"></script>
    <?php include("includes/fonts.html"); ?>

    <?php

    include($_SERVER['DOCUMENT_ROOT'].'/classes/UserServiceMgr.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/ReturnShortcuts.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/Input.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/Validate.php');

    //$uid = $_SESSION['user_id']
    $uid = 4;
    $dbvalue =  ReturnShortcuts::returnRegDetails($uid);

    if(!empty($_POST)){
        $success = UserServiceMgr::updateBasicUserDetails($uid, $_POST);
    }
    ?>

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
                        <strong>Update Account Details</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                <br><br>

                    <?php
                    if(!empty($_POST)) {
                        $dbvalue =  ReturnShortcuts::returnRegDetails($uid);
                        if ($success) {
                            echo '<' . 'div class= "alert alert-success" role="alert">
                                    <a href="homePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        Account Details updated successfully
                                    </div>';
                        } else {
                            echo '<' . 'div class="alert alert-danger">
                                    <a href="settingsPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Error</strong> - Account Details update was unsuccessful
                             </div>';
                        }
                    }
                    ?>

                    <form id="userRegDetails" class="form-horizontal" action="updateRegDetailsPage.php" role="form" id="updateRD" method="POST">
                        <fieldset>
                            <div class="form-group" id="email_group">
                                <label for="email" class="col-md-4 col-sm-5 control-label"><b>Email</b></label>
                                <div class="col-md-8 col-sm-7">
                                    <input type="email" class="form-control" id="email" name="email" maxlength="128" placeholder="<?php echo ($dbvalue['email']);?>" value="<?php echo Input::get('email');?>">
                                </div>
                                    <p class="col-md-4 col-sm-5"></p>
                                    <span class="<?php if($errors['email'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['email'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, e.g. kevin@example.com</span>
                                    <span class="<?php if($errors['email'] == 'error_unique') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_unique">Email address is already registered...</span>
                                </div>

                                <div class="form-group" id="confirm_email_group">
                                    <label for="confirm_email" class="col-md-4 col-sm-5 control-label"><b>Confirm Email</b></label>
                                    <div class="col-md-8 col-sm-7">
                                        <input type="email" class="form-control" id="confirm_email" name="confirm_email" maxlength="128" placeholder="<?php echo ($dbvalue['email']);?>" value="">
                                    </div>
                                    <p class="col-md-4 col-sm-5"></p>
                                    <span class="<?php if($errors['confirm_email'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['confirm_email'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Email addresses do not match...</span>
                                </div>

                                <div class="form-group" id="username_group">
                                    <label for="username" class="col-md-4 col-sm-5 control-label"><b>Username</b></label>
                                    <div class="col-md-8 col-sm-7">
                                        <input type="text" class="form-control" id="username" name="username" maxlength="32" placeholder= "<?php echo ($dbvalue['username']);?>" value="<?php echo Input::get('username');?>">
                                    </div>
                                    <p class="col-md-4 col-sm-5"></p>
                                    <span class="<?php if($errors['username'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['username'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid username, 3 - 32 characters(a-zA-Z0-9_-) only...</span>
                                    <span class="<?php if($errors['username'] == 'error_unique') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_unique">Username already in use...</span>
                                </div>

                                <div class="form-group" id="first_name_group">
                                    <label for="first_name" class="col-md-4 col-sm-5 control-label"><b>First Name</b></label>
                                    <div class="col-md-8 col-sm-7">
                                        <input type="text" class="form-control" id="first_name" name="first_name" maxlength="32" placeholder="<?php echo ($dbvalue['first_name']);?>" value="<?php echo Input::get('first_name');?>" autocomplete="on">
                                    </div>
                                    <p class="col-md-4 col-sm-5"></p>
                                    <span class="<?php if($errors['first_name'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['first_name'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, 2 - 32 characters(a-zA-Z) only...</span>
                                </div>

                                <div class="form-group" id="last_name_group">
                                    <label for="last_name" class="col-md-4 col-sm-5 control-label"><b>Last Name</b></label>
                                    <div class="col-md-8 col-sm-7">
                                        <input type="text" class="form-control" id="last_name" name="last_name" maxlength="32" placeholder="<?php echo ($dbvalue['last_name']);?>" value="<?php echo Input::get('last_name');?>" autocomplete="on">
                                    </div>
                                    <p class="col-md-4 col-sm-5"></p>
                                    <span class="<?php if($errors['last_name'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['last_name'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, 2 - 32 characters(a-zA-Z'-) only...</span>
                                </div>

                                <div class="form-group" id="password_group">
                                    <label for="password" class="col-md-4 col-sm-5 control-label"><b>Password</b></label>
                                    <div class="col-md-8 col-sm-7">
                                        <input type="password" class="form-control" maxlength="32" id="password" name="password" placeholder="Enter new password" value="">
                                    </div>
                                    <p class="col-md-4 col-sm-5"></p>
                                    <span class="<?php if($errors['password'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['password'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, 6 - 32 characters(a-zA-Z0-9_-) only...</span>
                                </div>

                                <div class="form-group" id="confirm_password_group">
                                    <label for="confirm_password" class="col-md-4 col-sm-5 control-label"><b>Confirm Password</b></label>
                                    <div class="col-md-8 col-sm-7">
                                        <input type="password" class="form-control" maxlength="32" id="confirm_password" name="confirm_password" placeholder="Enter new password" value="">
                                    </div>
                                    <p class="col-md-4"></p>
                                    <span class="<?php if($errors['confirm_password'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['confirm_password'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Passwords do not match...</span>
                                </div>
                                </fieldset>
                                <br>
                                <a href="settingsPage.php" class="btn btn-info center-inline" role="button">Return</a>
                                <input class="btn btn-info center-inline" id="continue_button" name="Send" type="submit" value="Apply Changes">
                                </form>


<!--                <form id="userRegDetails" action="updateRegDetailsPage.php" id="updateRD" method="POST">-->
<!--                    <fieldset class="form-group">-->
<!--                        <label for="Username">Username</label>-->
<!--                        <input type="text"  class="form-control" maxlength="32" name="username" placeholder= "--><?php //echo ($dbvalue['username']);?><!--" ><br /><br>-->
<!--                    </fieldset>-->
<!--                    <fieldset class="form-group">-->
<!--                        <label for="First_Name">First Name</label>-->
<!--                        <input type="text"  class="form-control" maxlength="32" name="first_name" placeholder="--><?php //echo ($dbvalue['first_name']);?><!--"><br /><br>-->
<!--                    </fieldset>-->
<!--                    <fieldset class="form-group">-->
<!--                        <label for="Last_Name">Last Name</label>-->
<!--                        <input type="text"  class="form-control" maxlength="32" name="last_name" placeholder="--><?php //echo ($dbvalue['last_name']);?><!--"><br /><br>-->
<!--                    </fieldset>-->
<!--                    <fieldset class="form-group">-->
<!--                        <label for="Password">Password</label>-->
<!--                        <input type="password"  class="form-control" maxlength="32" name="password" placeholder="Enter new password"><br /><br>-->
<!--                    </fieldset>-->
<!--                    <fieldset class="form-group">-->
<!--                        <label for="Email">Email</label>-->
<!--                        <input type="text"  class="form-control" maxlength="128" name="email" placeholder="--><?php //echo ($dbvalue['email']);?><!--"><br /><br>-->
<!--                    </fieldset>-->
<!--                    <br><br>-->
<!--                    <input type="submit" name="Send" class="btn btn-primary" Value="Apply Changes">-->
<!--                </form>-->


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