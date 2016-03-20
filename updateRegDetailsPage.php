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

    include($_SERVER['DOCUMENT_ROOT'].'/classes/UserServiceMgr.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/ReturnShortcuts.php');

    //$uid = $_SESSION['user_id']
    $uid = 1;
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

                <form id="userRegDetails" action="updateRegDetailsPage.php" id="updateRD" method="POST">
                    <fieldset class="form-group">
                        <label for="Username">Username</label>
                        <input type="text"  class="form-control" maxlength="32" name="username" placeholder= "<?php echo ($dbvalue['username']);?>" ><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="First_Name">First Name</label>
                        <input type="text"  class="form-control" maxlength="32" name="first_name" placeholder="<?php echo ($dbvalue['first_name']);?>"><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="Last_Name">Last Name</label>
                        <input type="text"  class="form-control" maxlength="32" name="last_name" placeholder="<?php echo ($dbvalue['last_name']);?>"><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="Password">Password</label>
                        <input type="password"  class="form-control" maxlength="32" name="password" placeholder="Enter new password"><br /><br>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="Email">Email</label>
                        <input type="text"  class="form-control" maxlength="128" name="email" placeholder="<?php echo ($dbvalue['email']);?>"><br /><br>
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