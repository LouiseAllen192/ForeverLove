<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $uid = 5;//$_SESSION['user_id'];

    $db = DB::getInstance();
    $hobbies = $db->query('SELECT * FROM user_hobbies ORDER BY hobby_name')->results();
    $preferences = SearchServiceMgr::searchablePreferences();

    if(isset($_POST['submit'])){
        $selectedPreferences = [];
        foreach($preferences as $preference => $options){
            $setPreference = strtolower(str_replace(' ', '_',$preference));
            if(isset($_POST[$setPreference]) && $_POST[$setPreference] != 1){
                $selectedPreferences[$setPreference] = $_POST[$setPreference];
            }
        }
        if(isset($_POST['list'])){
            $results = SearchServiceMgr::byCriteria($uid, $_POST['list'], $selectedPreferences);
        }
        else if(count($selectedPreferences)){
            $results = SearchServiceMgr::byCriteria($uid, [], $selectedPreferences);
        }
        else{
            $sql = "SELECT user_id,username,tag_line,city,TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) AS age";
            $sql .= " FROM registration_details JOIN preference_details USING(user_id) WHERE user_id != $uid";
            $results = $db->query($sql)->results();
        }
        if(isset($_POST['age'])){
            $results = SearchServiceMgr::filterAge($_POST['age'], $results);
        }
    }
    ?>
    <title>Search Page</title>
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
                <h2 class="intro-text text-center">
                    <strong>Search By Criteria</strong>
                </h2>
                <hr class="tagline-divider"><br>
                <form class="form-horizontal" role="form" method="post">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Hobbies
                                    </div>
                                    <div class="panel-body">
                                        <div style="height: 350px;overflow: auto;">
                                            <?php
                                            foreach($hobbies as $hobby){?>
                                                <div class="pull-left" style="clear:both;">
                                                    <label class="text-muted">
                                                        <input type="checkbox" name="list[]" value="<?php echo $hobby->hobby_id;?>"><?php echo $hobby->hobby_name;?>
                                                    </label>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Results
                                    </div>
                                    <div class="panel-body">
                                        <div style="height: 350px;overflow: auto;">
                                            <?php
                                            if(isset($results)) {
                                                foreach ($results as $result){
                                                    ?>
                                                    <a href="profilePage.php?uid=<?php echo $result->user_id;?>">
                                                        <div class="display_box">
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <div class="media">
                                                                        <div class="media-left">
                                                                            <img  height="96" width="96" class="media-object" src="<?php echo $db->query("SELECT image_path FROM images WHERE user_id = '$result->user_id' && image_id = '1'")->results()[0]->image_path;?>"/>
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
                                                    <?php
                                                }
                                            }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-3">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Preferences
                                    </div>
                                    <div class="panel-body">
                                        <div style="height: 350px;overflow: auto;">
                                            <select class="form-control" name="age">
                                                <option disabled selected>Age Range</option>
                                                <option value="18">18 - 24</option>
                                                <option value="25">25 - 34</option>
                                                <option value="35">35 - 44</option>
                                                <option value="45">45 - 54</option>
                                                <option value="55">55 or Older</option>
                                            </select>
                                            <?php
                                            foreach($preferences as $preference => $options){?>
                                                <select class="form-control" name="<?php echo strtolower(str_replace(' ', '_',$preference));?>">
                                                    <option disabled selected><?php echo $preference;?></option>
                                                    <?php
                                                    foreach($options as $option => $value){?>
                                                        <option value="<?php echo $option;?>"><?php echo $value;?></option>;
                                                        <?php
                                                    }?>
                                                </select>
                                                <?php
                                            }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <br>
                    <div class="col-xs-12">
                        <input class="btn btn-info" id="search_button" name="submit" type="submit" value="Search">
                    </div>
                </form>
                <br><br><br>
                <br><br>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>