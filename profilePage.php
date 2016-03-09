<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Profile Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-profile.css" rel="stylesheet">
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
                    <!--image source to be got from database-->
                    <div class="profile-pic"><img src="includes/pics/ProfilePic.jpg" class="img-responsive" alt="Profile Picture"></div>
                    <br><br>
                    <h1 class="user-name">JimBob27</h1>
                    <hr class="tagline-divider">
                    <h2>
                        <small>
                            <strong>Here to meet a lovely girl :)</strong>
                        </small>
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">All about me</h2>
                    <hr>
                    <hr class="visible-xs">
                    <p>Age: 26</p>
                    <p>Sex: Male</p>
                    <p>Smoker: No</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Intrests & Hobbies</h2>
                    <hr>
                    <p>Cutting turf</p>
                    <p>Telling dad jokes</p>
                </div>
            </div>
        </div>

    </div>
    <?php include("includes/footer.html"); ?>
</body>

</html>