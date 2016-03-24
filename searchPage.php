<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $hobbies = DB::getInstance()->query('SELECT * FROM user_hobbies ORDER BY hobby_name')->results();
    $preferences = ReturnShortcuts::searchablePreferences();

    if(isset($_POST['submit'])){
        $selectedPreferences = [];
        foreach($preferences as $preference => $options){
            $setPreference = strtolower(str_replace(' ', '_',$preference));
            if(isset($_POST[$setPreference]) && $_POST[$setPreference] != 1){
                $selectedPreferences[$setPreference] = $_POST[$setPreference];
            }
        }
        if(isset($_POST['list'])) {
            $results = SearchServiceMgr::byCriteria($_POST['list'], $selectedPreferences);
        }
        else{
            $results = SearchServiceMgr::byCriteria([], $selectedPreferences);
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
                                            <?php
                                            foreach($preferences as $preference => $options){?>
                                                <select class="form-control" name="<?php echo strtolower(str_replace(' ', '_',$preference));?>">
                                                    <option disabled selected><?php echo $preference;?></option>
                                                    <?php
                                                    foreach($options as $option => $value){?>
                                                        <option value="<?php echo $option;?>"><?php echo $value;?></option>';
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