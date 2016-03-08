<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Admin Login Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-admin.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>
    <?php include("includes/navbarAdmin.html"); ?>
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
                <p>
                    <br><br>
                    <form id='login' action='login.php' method='post' accept-charset='UTF-8'>
                            <input type='hidden' name='submitted' id='submitted' value='1'/>

                            <label for='username' >Username</label>
                            <input type='text' name='username' id='username'  maxlength="50" />
                            <br><br>
                            <label for='password' >Password</label>
                            <input type='password' name='password' id='password' maxlength="50" />
                            <br><br>
                            <input type='submit' name='Submit' value='Submit' />
                    </form>
                    <br><br>
                    <br><br>
                </p>
            </div>
    </div>
</div>
<?php include("includes/footer.html"); ?>
</body>

</html>