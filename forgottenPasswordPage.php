<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("PHPMailer/class.phpmailer.php");
    include("PHPMailer/class.smtp.php");


    ?>

    <title>Forgotten Password</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <script src="scripts/forgottenPasswordValidation.js"></script>
    <?php include("includes/fonts.html");

    $errors = array();


    if(Input::exists()){
        $emailExists = false;
        if(isset($_POST['email'])){
            $emailExists = UserServiceMgr::checkIfEmailExists($_POST['email']);
        }

        if(isset($_POST['email']) && $emailExists){
            $errors = UserServiceMgr::getEmailErrors($_POST);
        }
        else{
            $errors['email'] = 'error_wrong_email';
        }
    }



   function createRandomPassword() {
        $chars = "ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789";
        $i = 0;
        $pass = '' ;

        while ($i <= 8) {
            $num = mt_rand(0,61);
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }

   function sendMail($email, $pw) {

       $mail = new PHPMailer;
       $mail->From = "noreply@foreverlove.ddns.net";
       $mail->FromName = "Forever Love";
       $mail->addAddress($email);
       $mail->Subject = "Reset Password";
       $mail->Body = "You have requested to reset you password.\n
                    This is your new password to log in: $pw \n\n Once logged in please go to Settings -> Update password to set your own password";
       $mail->IsSMTP();

       if(!$mail->send()) {
           return $mail->ErrorInfo;
       }
       else {
           return true;
       }
    }


    ?>

</head>

<body class="full">
<?php include("includes/navbarNotLoggedIn.html"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong>Forgotten Password</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>

                    <br><br>

                <div class = "panel panel-default">
                    <div class = "panel-body">

                             <form id="reset_password" class="form-horizontal" role="form" method="post">
                                 <fieldset>
                                     <div class="form-group" id="email_group">
                                         <label for="email" class="col-md-4 col-sm-5 control-label"><b>Email</b></label>
                                         <div class="col-md-8 col-sm-7">
                                             <input type="email" class="form-control" id="email" name="email" maxlength="128" value="<?php echo Input::get('email');?>">
                                         </div>
                                         <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                             <span class="<?php if($errors['email'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                             <span class="<?php if($errors['email'] == 'error_wrong_email') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_wrong_email">Email address is not associated with registered account...</span>
                                         </div>
                                     </div>
                                 </fieldset>
                                 <a href="welcomePage.php" class="btn btn-info center-inline" role="button">Return</a>
                                 <input class="btn btn-info center-inline" id="reset_Password" name="reset_password" type="submit" value="Reset Password">
                             </form>
                        <br><br>


                        <?php
                        if(isset($_POST['email']) && !$errors) {
                            $email = $_POST['email'];
                            $pw = createRandomPassword();
                            $changes = array();
                            $changes['password'] = password_hash($pw, PASSWORD_DEFAULT);
                            $uid = UserServiceMgr::getUserIdFromEmail($_POST['email']);
                            $where = "user_id = '".$uid."'";

                            $success = sendMail($email, $pw);

                            $success = DB::getInstance()->update('registration_details', $where , $changes);
                            if ($success) {
                                $successMail = sendMail($email, $pw);
                                if ($successMail) {
                                    $alertType = "success";
                                    $alertMsg = "Rest password email has successfully sent. You can now log in with the new password sent to you.";
                                } else {
                                    $alertType = "danger";
                                    $alertMsg = "<strong>Error</strong> - Something went wrong - email did not send. Please try again";
                                }
                            }?>

                            <div class="alert alert-<?php echo $alertType?>">
                                <a href="WelcomePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $alertMsg ?>
                            </div><br><br>
                            <a href="welcomePage.php" class="btn btn-info center-inline" role="button">Return to Welcome page <span class="glyphicon glyphicon-arrow-left"></span></a>

                        <?php }

                        ?>


                    </div>
                </div>





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