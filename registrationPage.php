<!DOCTYPE html>
<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>Register Prefrences</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>
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
                        <strong>New Registration</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                    <br>

                <form role="form" method="post">
                    <label for="Email" class="h5"><b>Email Address:</b></label>
                    <input type="email" class="form-control" name="Email"  value="<?php echo Input::get('Email');?>" autocomplete="on">

                    <label for="Username" class="h5"><b>Username:</b></label>
                    <input type="text" class="form-control" name="Username"  value="<?php echo Input::get('Username');?>">

                    <label for="First_Name" class="h5"><b>First Name:</b></label>
                    <input type="text" class="form-control" name="First_Name" value="<?php echo Input::get('First_Name');?>" autocomplete="on">

                    <label for="Last_Name" class="h5"><b>Last Name:</b></label>
                    <input type="text" class="form-control" name="Last_Name" value="<?php echo Input::get('Last_Name');?>" autocomplete="on">

                    <label for="Password" class="h5"><b>Password:</b></label>
                    <input type="password" class="form-control" name="Password" value="">

                    <label for="Confirm_Password" class="h5"><b>Confirm Password:</b></label>
                    <input type="password" class="form-control" name="Confirm_Password" value="">

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
<?php include("includes/footer.html"); ?>
</body>

</html>
