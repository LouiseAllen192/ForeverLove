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
                <form onsubmit=""(); return false; id="form" action="adminLoginPage.php" method="post" enctype="multipart/form-data">
                    Username: <input type="text" name="username" />
                    <br>
                    Password:<input type="password" name="password" />
                    <br><br>
                    <input type="submit" value="Login" name="Submit" />
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

