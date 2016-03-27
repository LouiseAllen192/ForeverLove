<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $results = SearchServiceMgr::suggestions($_SESSION['user_id']);
    ?>
    <title>Suggestions Page</title>
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
                <hr class="tagline-divider">
                <h2>
                    <small>
                        <strong>Suggestions</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <br>
                    <?php
                    if(isset($results)) {
                        foreach ($results as $result){
                            ?>
                            <p class="col-sm-2 col-xs-1"></p>
                            <div class="col-sm-8 col-xs-10">
                                <a href="profilePage.php?uid=<?php echo $result->user_id;?>">
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
                                </a>
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