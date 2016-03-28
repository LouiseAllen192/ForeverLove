<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Contact Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <?php include("includes/fonts.html");
    $loggedin = true;

    if(isset($_GET['loggedin'])){
        $loggedin = false;
    }
    ?>

</head>

<body class="full">

<?php
if($loggedin){ include("includes/navbar.html");}
else{include("includes/navbarNotLoggedIn.html");}
 ?>

<!--Main page content-->

<div class="container">

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <br><br>
                <hr>
                <h2 class="intro-text text-center">Contact Us</h2>
                <hr>
                <hr class="visible-xs">
                <br>


                <div class="row">

                    <div class="col-md-12 text-center">
                        <div class="col-md-4 text-center">
                            <img src="includes/pics/telephone.jpg" class="img-circle" alt="telephone" height="250" width="250">
                        </div>
                        <div class="col-md-4 text-center">
                            <p><br><span class="glyphicon glyphicon-phone-alt"></span>  Phone:</p>
                            <hr class="tagline-divider"><br>
                            <p>+00-12345678</p><br><br><br>
                        </div>
                        <div style="clear:both;"><div></div></div>
                        <div style="clear:both;"><div></div></div>
                        <div class="row"><br><br></div>
                        <div class="col-md-4 text-center">
                            <img src="includes/pics/email.jpg" class="img-circle" alt="email" height="250" width="250">
                        </div>
                        <div class="col-md-4 text-center">
                            <p><span class="glyphicon glyphicon-envelope"></span>  Email:</p>
                            <hr class="tagline-divider"><br>
                            <p>info@foreverlove.ie</p><br><br><br>
                        </div>
                        <div style="clear:both;"><div></div></div>
                        <div style="clear:both;"><div></div></div>
                        <div class="row"><br><br></div>
                        <div class="col-md-4 text-center">
                            <img src="includes/pics/address.jpg" class="img-circle" alt="address" height="250" width="250">
                        </div>
                        <div class="col-md-4 text-center">
                            <p><span class="glyphicon glyphicon-globe"></span>  Address</p>
                            <hr class="tagline-divider"><br>
                            <p>72 Pearse Street<br>Sallynogin<br>Dublin 1<br>Co.Dublin</p><br><br><br><br>
                        </div>
                        <div style="clear:both;"><div></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
<?php include("includes/footer.html"); ?>
</body>

</html>