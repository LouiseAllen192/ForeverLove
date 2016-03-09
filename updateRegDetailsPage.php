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
    <?php include("includes/fonts.html"); ?>

    <?php

    // All to be uncommented and used when database is working/populated

    //    $uid = 001; //needs to be got through global data possibly???

    //$registrationDetails = DB::getInstance()->get('preference_details', ['User_id', '=', $uid])->results()[0];
    //    $dbvalue = array("Username"=>$registrationDetails->Username, "First_Name"=>$registrationDetails->First_Name,
    //                      "Last_Name"=>$registrationDetails->Last_Name, "Password"=>$registrationDetails->Password,
    //                      "Email"=>$registrationDetails->Email);

    //hardcoded array to be replaced with code above when database working
    $dbvalue = array("Username"=>"javanator89", "First_Name"=>"Louise", "Last_Name"=>"Allen","Password"=>"1x6f72", "Email"=>"louise.allen192@gmail.com");
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

                <form id="userRegDetails" action="scripts/updateRegDetails.php" id="updateRD" method="get">
                    <fieldset class="form-group">
                        <label for="Username">Username</label>
                        <input type="text"  class="form-control" maxlength="32" name="Username" placeholder= "<?php echo ($dbvalue['Username']);?>" ><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="First_Name">First Name</label>
                        <input type="text"  class="form-control" maxlength="32" name="First_Name" placeholder="<?php echo ($dbvalue['First_Name']);?>"><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="Last_Name">Last Name</label>
                        <input type="text"  class="form-control" maxlength="32" name="Last_Name" placeholder="<?php echo ($dbvalue['Last_Name']);?>"><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="Password">Password</label>
                        <input type="text"  class="form-control" maxlength="32" name="Password" placeholder="<?php echo ($dbvalue['Password']);?>"><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="Email">Email</label>
                        <input type="text"  class="form-control" maxlength="128" name="Email" placeholder="<?php echo ($dbvalue['Email']);?>"><br /><br>
                    </fieldset>
                    <br><br>
                    <input type="submit" name="Send" class="btn btn-primary" Value="Apply Changes">
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