<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $db = DB::getInstance();
    $me = $_SESSION['user_id'];
    $results = SearchServiceMgr::suggestions($me);
    ?>
    <title>Suggestions Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">

</head>

<body class="full">
<?php include("includes/navbar.php"); ?>

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
                    if($db->query("SELECT account_type FROM account_details WHERE user_id = '$me'")->results()[0]->account_type == 'Premium'){
                        if(isset($results)){
                            foreach ($results as $result) {
                                ?>
                                <div class="row">
                                    <div class="col-xs-offset-2">
                                        <div class="col-xs-10">
                                            <a href="profilePage.php?uid=<?php echo $result->user_id; ?>">
                                                <div class="display_box">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <img height="78" width="78" class="media-object" title="Profile Image" src="<?php echo $db->query("SELECT image_path FROM images WHERE user_id = '$result->user_id' && image_id = '1'")->results()[0]->image_path; ?>">
                                                                </div>
                                                                <div class="media-body" style="padding-top: 3px;">
                                                                    <h4 class="media-heading" title="Username"><?php echo $result->username; ?></h4>
                                                                    <small style="white-space: nowrap;" title="Tag Line"><?php echo $result->tag_line; ?></small>
                                                                </div>
                                                                <div class="media-right media-middle">
                                                                    <h5 class="media-heading" title="Location"><?php echo $result->city; ?></h5>
                                                                </div>
                                                                <div class="media-right media-middle">
                                                                    <span class="badge badge-notify" title="Common Interests"><?php echo $result->Total;?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }else{?>
                        <a href="upgradeMembership.php">
                            <div class= "alert alert-success" role="alert">
                                <p class="close" data-dismiss="alert" aria-label="close"></p>
                                Please upgrade your account to avail of these services...
                            </div>
                        </a>
                        <?php
                    }
                    ?>
                <br><br>
                <br><br>

            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.html"); ?>
</body>

</html>