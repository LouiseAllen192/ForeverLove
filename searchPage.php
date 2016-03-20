<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $hobbies = DB::getInstance()->query('SELECT * FROM user_hobbies ORDER BY hobby_name')->results();
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

                <?php
                $n = 0;
                foreach($hobbies as $hobby){
                    if($n++ % 9 == 0){?>
                    <div class="col-lg-12">
                        <br>
                        <div class="btn-group" id="12" data-toggle="toggle">
                        <?php
                    }?>
                            <label class="btn btn-default">
                                <input type="checkbox" name="<?php echo $hobby->hobby_name;?>" id="<?php echo $hobby->hobby_name;?>"><?php echo $hobby->hobby_name;?>
                            </label>
                    <?php
                    if($n % 9 == 0){?>
                        </div>
                    </div>
                        <?php
                    }
                }?>


                    <br><br>
                    <br><br>
                <div class="col-lg-12">
                    <input class="btn btn-info" id="search_button" type="submit" value="Search">
                </div>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>