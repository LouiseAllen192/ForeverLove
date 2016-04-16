<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Settings Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-settings.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

</head>

<body class="full">
<?php include("includes/navbar.php"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <h2>
                    <small>
                        <strong>Settings</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                        <br>


                        <div class="row">

                            <div class="col-lg-1 col-sm-4"></div>
                            <div class = "col-lg-10 col-sm-10">
                                <div class="col-lg-4 col-sm-6 text-center">
                                    <a href ="viewMembershipStatusPage.php"><img class="img-circle img-responsive img-center" src="http://gdurl.com/X2ql" alt="Profile Icon"></a>
                                    <a href="viewMembershipStatusPage.php"><h4>View membership status</h4></a>
                                    <p><br></p>
                                </div>
                                <div class="col-lg-4 col-sm-6 text-center">
                                    <a href = "updateRegDetailsPage.php"><img class="img-circle img-responsive img-center" src="http://gdurl.com/jBkk" alt="Messages Icon"></a>
                                    <a href="updateRegDetailsPage.php"><h4>Update your basic account details</h4></a>
                                    <p><br></p>
                                </div>
                                <div class="col-lg-4 col-sm-6 text-center">
                                    <a href = "updatePassword.php"><img class="img-circle img-responsive img-center" src="http://gdurl.com/CRJI" alt="Search Icon"></a>
                                    <a href="updatePassword.php"><h4>Update your password</h4></a><br><br>
                                    <p><br></p>
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-4"></div>
                        </div>

                        <div class="row"></div>

                        <div class="row">
                            <div class="col-lg-1 col-sm-4"></div>
                            <div class = "col-lg-10 col-sm-10">
                                <div class="col-lg-4 col-sm-9 text-center">
                                    <a href = "updatePreferencesPage.php"><img class="img-circle img-responsive img-center" src="http://gdurl.com/iAsL" alt="Suggestions Icon"></a>
                                    <a href="updatePreferencesPage.php"><h4>Update your prefrences</h4></a>
                                    <p><br></p>
                                </div>
                                <div class="col-lg-4 col-sm-9 text-center">
                                    <a href = "updateHobbiesPage.php"><img class="img-circle img-responsive img-center" src="http://gdurl.com/UNQK" alt="View All Icon"></a>
                                    <a href="updateHobbiesPage.php"><h4>Update your hobbies</h4></a>
                                    <p><br></p>
                                </div>
                                <div class="col-lg-4 col-sm-9 text-center">
                                    <a href = "contactPage.php"><img class="img-circle img-responsive img-center" src="http://gdurl.com/nyDn" alt="View All Icon"></a>
                                    <a href="contactPage.php"><h4>View ForeverLove Contact Details</h4></a>
                                    <p><br></p>
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-4"></div>
                        </div>

                    </div>
                </div>

                </p>
            </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>