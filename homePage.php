<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        require_once 'core/init.php';
        include("includes/metatags.html");
    ?>
    <title>Home Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-home.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

</head>

<body>
    <?php include("includes/navbar.html");?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Menu</h2>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <a href ="profilePage.php"><img class="img-circle img-responsive img-center" src="http://gdurl.com/G6Qb" alt="Profile Icon"></a>
                <a href="profilePage.php"><h3>My Profile</h3></a>
                <p><br></p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <a href = "messagesPage.php"><img class="img-circle img-responsive img-center" src="http://gdurl.com/HKxj" alt="Messages Icon"></a>
                <a href="messagesPage.php"><h3>Messages</h3></a>
                <p><br></p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <a href = "searchPage.php"><img class="img-circle img-responsive img-center" src="http://gdurl.com/QcJC" alt="Search Icon"></a>
                <a href="searchPage.php"><h3>Search</h3></a>
                <p><br></p>
            </div>
        </div>
        <div class="row"><br><br><br></div>
        <div class="row">
            <div class="col-lg-4 col-sm-6 text-center">
                <a href = "suggestionsPage.php"><img class="img-circle img-responsive img-center" src="http://gdurl.com/b_Os" alt="Suggestions Icon"></a>
                <a href="suggestionsPage.php"><h3>Suggestions</h3></a>
                <p><br></p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <a href = "viewAllPage.php"><img class="img-circle img-responsive img-center" src="http://gdurl.com/n49k" alt="View All Icon"></a>
                <a href="viewAllPage.php"><h3>View All</h3></a>
                <p><br></p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <a href = "blindDatePage.php"><img class="img-circle img-responsive img-center" src="http://gdurl.com/khXo" alt="Blind Date Icon"></a>
                <a href="blindDatePage.php"><h3>Blind Date</h3></a>
                <p><br></p>
            </div>
        </div>

        <hr>
    </div>
    <?php include("includes/footer.html"); ?>
</body>
</html>
