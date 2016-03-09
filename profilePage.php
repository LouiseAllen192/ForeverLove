<!DOCTYPE html>
<html>

<head>

<!--    TOTALLY FUCKING BROKE THIS PAGE - SOZ-->
<!--    I'LL FIX IT LATER-->
<!--    -LOUISE-->

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>Profile Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-profile.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

    <?php
    include($_SERVER['DOCUMENT_ROOT'].'/classes/ReturnShortcuts.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/User.php');


    //$uid = getUserID(); // figure out whether logged in user or other user ?!??
    $uid =1;
    $user = new User($uid);


         function calculateAge($dob){
            //date in mm/dd/yyyy format; or it can be in other formats as well
            $birthDate = "02/19/1991";
            //explode the date to get month, day and year
            $birthDate = explode("/", $birthDate);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                ? ((date("Y") - $birthDate[2]) - 1)
                : (date("Y") - $birthDate[2]));
            echo "Age is:" . $age;
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
                    <!--image source to be got from database-->
                    <div class="profile-pic"><img src="includes/pics/ProfilePic.jpg" class="img-responsive" alt="Profile Picture"></div>
                    <br><br>
                    <h1 class="user-name"><?php echo ($user->getUsername());?></h1>
                    <hr class="tagline-divider">
                    <h2>
                        <small>
                            <strong><?php echo ($user->getUserPrefrences()->getTagLine());?></strong>
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
                    <p>Age: <?php echo (calculateAge($user->getUserPreferences()->getDateob()));?></p>
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