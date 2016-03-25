<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $uid = $_SESSION['user_id'];

    $sql = "SELECT user_id,username,tag_line,city,gender,seeking FROM registration_details JOIN preference_details USING(user_id) WHERE user_id != '$uid'";
    $results = SearchServiceMgr::filterSeekingGender($uid, DB::getInstance()->query($sql)->results());
    ?>
    <title>View All Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">

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
                        <strong>View All</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <br><br>
                    <?php
                    if(isset($results)){
                        foreach ($results as $result){
                            ?>
                            <div class="display_box">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="media">
                                            <div class="media-left">
                                                <img class="media-object" src="https://s3.amazonaws.com/uifaces/faces/twitter/calebogden/73.jpg"/>
                                            </div>
                                            <div class="media-body" style="padding-top: 3px;">
                                                <h4 class="media-heading"><?php echo $result->username; ?></h4>
                                                <small style="white-space: nowrap;"><?php echo $result->tag_line; ?></small>
                                            </div>
                                            <div class="media-right media-middle">
                                                <h5 class="media-heading"><?php echo $result->city; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }?>
                    <br><br>
                    <br><br>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.html"); ?>
</body>

</html>