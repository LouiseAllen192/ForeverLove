<!DOCTYPE html>
<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>Registration Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
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
                        <strong>Please Complete Registration</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                    <br>

                <form name="regForm" class="form-horizontal" role="form" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="Email" class="col-md-4 control-label"><b>Email</b></label>
                            <div class="col-md-7">
                                <input type="email" class="form-control" name="Email"  value="">
                            </div>
                            <input class="col-md-1" type="checkbox" disabled name="Valid_Email">
                        </div>

                        <div class="form-group">
                            <label for="Confirm_Email" class="col-md-4 control-label"><b>Confirm Email</b></label>
                            <div class="col-md-7">
                                <input type="email" class="form-control" name="Confirm_Email"  value="">
                            </div>
                            <input class="col-md-1" type="checkbox" disabled name="Valid_Confirm_Email">
                        </div>

                        <div class="form-group">
                            <label for="Username" class="col-md-4 control-label"><b>Username</b></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="Username"  value="<?php echo Input::get('Username');?>">
                            </div>
                            <input class="col-md-1" type="checkbox" disabled name="Valid_Username">
                        </div>

                        <div class="form-group">
                            <label for="First_Name" class="col-md-4 control-label"><b>First Name</b></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="First_Name" value="<?php echo Input::get('First_Name');?>" autocomplete="on">
                            </div>
                            <input class="col-md-1" type="checkbox" disabled name="Valid_First_Name">
                        </div>

                        <div class="form-group">
                            <label for="Last_Name" class="col-md-4 control-label"><b>Last Name</b></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="Last_Name" value="<?php echo Input::get('Last_Name');?>" autocomplete="on">
                            </div>
                            <input class="col-md-1" type="checkbox" disabled name="Valid_Last_Name">
                        </div>

                        <div class="form-group">
                            <label for="Password" class="col-md-4 control-label"><b>Password</b></label>
                            <div class="col-md-7">
                                <input type="password" class="form-control" name="Password" value="">
                            </div>
                            <input class="col-md-1" type="checkbox" disabled name="Valid_Password">
                        </div>

                        <div class="form-group">
                            <label for="Confirm_Password" class="col-md-4 control-label"><b>Confirm Password</b></label>
                            <div class="col-md-7">
                                <input type="password" class="form-control" name="Confirm_Password" value="">
                            </div>
                            <input class="col-md-1" type="checkbox" disabled name="Valid_Confirm_Password">
                        </div>
                    </fieldset>

                    <br><br>
                    <a href="welcomePage.php" class="btn btn-info center-inline" role="button">Back</a>
                    <input class="btn btn-info center-inline" type="submit" value="Continue">
                </form>
                <br><br>
                <br><br>
                </p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function checkForm(){
        if(this.Email.value == "" || !this.Valid_Email.checked){
            alert("Please enter a valid Email address.")
            this.Email.focus();
            return false;
        }
        if(this.Confirm_Email.value != this.Email.value || !this.Valid_Confirm_Email.checked){
            alert("Email addresses do not match");
            this.Confirm_Email.focus();
            return false;
        }
    }
</script>
<?php include("includes/footer.html"); ?>
</body>

</html>
