<!DOCTYPE html>
<html>

<head>
    <?php
    require_once '../core/init.php';
    include("../includes/metatags.html");
    include("../includes/fonts.html");

    $db = DB::getInstance();
    $results = $db->query("SELECT user_id,username,tag_line,city FROM registration_details JOIN preference_details USING(user_id)")->results();

    $perPage = 8;
    $pageNum = (isset($_GET['pageNum'])) ? $_GET['pageNum'] : 1;
    $n = count($results);
    $lastPage = intval(($n % $perPage == 0) ? $n / $perPage : ($n / $perPage) + 1)
    ?>
    <title>View All Page</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom-base-page.css" rel="stylesheet">

</head>

<body class="full">
<?php include("../includes/navbarAdmin.html"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <hr class="tagline-divider">
                <h2>
                    <small>
                        <strong>View All</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <br>
                <?php
                if(isset($results)){
                    $endPagination = ($pageNum == $lastPage) ? $n : $pageNum * $perPage;
                    for($i = ($pageNum * $perPage) - $perPage; $i < $endPagination; $i++){
                        ?>
                        <div class="row">
                            <div class="col-xs-offset-2">
                                <div class="col-xs-10">
                                    <a href="../profilePage.php?uid=<?php echo $results[$i]->user_id;?>">
                                        <div class="display_box">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <?php $result_uid = $results[$i]->user_id; ?>
                                                            <img height="78" width="78" class="media-object" src="../<?php echo $db->query("SELECT image_path FROM images WHERE user_id = '$result_uid' && image_id = '1'")->results()[0]->image_path;?>"/>
                                                        </div>
                                                        <div class="media-body" style="padding-top: 3px;">
                                                            <h4 class="media-heading"><?php echo $results[$i]->username; ?></h4>
                                                            <small style="white-space: nowrap;"><?php echo $results[$i]->tag_line; ?></small>
                                                        </div>
                                                        <div class="media-right media-middle">
                                                            <h5 class="media-heading"><?php echo $results[$i]->city; ?></h5>
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
                    if($n > $perPage){
                        ?>
                        <div style="margin: 20px;">
                            <ul class="pagination">
                                <li><a href="viewAllPage.php?pageNum=<?php echo 1; ?>">&laquo;</a></li>
                                <?php
                                if($pageNum > 2){
                                    $i = $pageNum - 2;
                                    $n = $pageNum + 2;
                                }
                                else{$i = 1; $n = 5;}
                                if($pageNum > ($lastPage - 3)){
                                    $n = $lastPage;
                                    $i = $n - 4;
                                }
                                for(; $i <= $n; $i++){?>
                                    <li><a href="viewAllPage.php?pageNum=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                }
                                ?>
                                <li><a href="viewAllPage.php?pageNum=<?php echo $lastPage; ?>">&raquo;</a></li>
                            </ul>
                        </div>
                        <?php
                    }
                }?>
                <br><br>
                <br><br>
                <a href="../secret_location/adminHomePage.php" class="btn btn-info pull-left" role="button"><span class="glyphicon glyphicon-chevron-left"></span> Back To Menu</a>
            </div>
        </div>
    </div>
</div>
<?php include("../includes/footer.html"); ?>
</body>

</html>