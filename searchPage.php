<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $hobbies = DB::getInstance()->query('SELECT * FROM user_hobbies ORDER BY hobby_name')->results();

    if(isset($_POST['list'])){
        $results = SearchServiceMgr::byCriteria($_POST['list']);
    }
    ?>
    <title>Search Page</title>
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
                        <strong>Search By Criteria</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <form id="reg_form" class="form-horizontal" role="form" method="post">
                    <?php
                    $n = 0;
                    $last = count($hobbies);
                    foreach($hobbies as $hobby){
                        if($n++ % 7 == 0){
                            echo '<div class="row"><br>';
                            echo '<div class="col-xs-12"><br>';
                        }
                        echo '<label class="btn btn-default">';
                        echo '<input type="checkbox" name="list[]" value="'.$hobby->hobby_id.'">'.$hobby->hobby_name;
                        echo '</label>';
                        if($n % 7 == 0 || $n == $last){
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    ?>
                        <br><br>
                    <div class="col-xs-12">
                        <input class="btn btn-info" id="search_button" type="submit" value="Search">
                    </div>
                </form>
                <br><br><br>
                <?php
                if(isset($results)) {
                    foreach ($results as $result){
                        ?>
                        <div class="display_box">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>