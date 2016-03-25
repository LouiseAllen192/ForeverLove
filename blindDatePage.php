<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Blind Date Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
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
                        <strong>Blind Date</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                   <?php
                        if(!empty($_POST))
                        {
                            //$uid = 1; //temp - need to get from global array
                            $uid = $_SESSION['user_id'];
                            $alreadyIn = DB::getInstance()->query("SELECT * FROM blind_date WHERE user_id = $uid")->results();
                            if(empty($alreadyIn))//THIS IS NPOT FINISHED
                            {
                                $user = DB::getInstance()->query("SELECT * FROM preference_details WHERE user_id = $uid")->results();
                                $seeking = $user[0]->seeking;
                                $gender = $user[0]->gender;
                                //get all people from Blind Date table here and try to find an eligible match
                                //if no match found, enter user into database
                                DB::getInstance()->insert('blind_date', ['user_id' => $uid, 'seeking' => $seeking, 'gender' => $gender]);
                                //if match found, remove other user from database and add conversation to conversations DB
                            }
                        }
                   ?>
                    <br><br>
                    Blind Date is the new way to find your soulmate!
                    <br><br>
                    Blind Date matches you anonymously with another user based soley on your sexual orientation, meaning that you could end up hitting it off with someone just like you, or you could find out if opposites attract!
                    <br><br>
                    If after a certain amount of messages have been exchanged between the two of you, you may choose to reveal your profiles to one another!
                    <br><br>
                    <form action="blindDatePage.php" method="post">
                        <button name="SignUp" value="SignUp" class="btn btn-warning">Find Me A Blind Date!</button>
                    </form>
                </p>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>