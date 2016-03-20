<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $hobbies = DB::getInstance()->query('SELECT * FROM user_hobbies ORDER BY hobby_name')->results();

    if(Input::exists()){
        $sql = "SELECT user_id,";
        $last = count($_POST['list']);
        $n = 1;
        foreach($_POST['list'] as $item){
            $sql .= "MAX(CASE WHEN hobby_id = '".$item."' THEN hobby_preference END)AS '".$item."'";
            if($n++ < $last){
                $sql .= ",";
            }
        }
        $sql .= " FROM (SELECT user_id,hobby_id,hobby_preference FROM registration_details JOIN";
        $sql .= " user_hobby_preferences USING(user_id) ORDER BY user_id)x GROUP BY user_id";
        $results = DB::getInstance()->query($sql)->results();
        foreach($results as $result){
            foreach($result as $value){
                echo '<br>'.$value;
            }
        }
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
                <br><br><br><br><br>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>