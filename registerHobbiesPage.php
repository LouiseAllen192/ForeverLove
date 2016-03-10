<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>Register Hobbies</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>
    <?php

        function createOption($name){
            $html = '<div class="col-md-4"'.'>'.'<div class="form-group">'. '<label class="checkbox-inline">';
            $html .= '<input type="checkbox" name="'.$name.'" id="'.$name.'">';
            $html .= str_replace('_', ' ', $name);
            $html .= '<'.'/label></div></div>';
            echo $html;
        }
    ?>

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
                        <strong>Register Hobbies</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <br>



                <form role ="form" class="form-inline" action="scripts/registerHobbies.php" method="get">
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>

                                <?php
                                createOption('Reading');
                                createOption("Cinema");
                                createOption("Shopping");
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Socializing");
                                createOption("Travelling");
                                createOption("Walking");
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Exercise");
                                createOption("Soccer");
                                createOption("Dance");
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Horses");
                                createOption("Painting");
                                createOption("Running");
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Eat_Out");
                                createOption("Cooking");
                                createOption("Computers");
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Bowling");
                                createOption("Writing");
                                createOption("Skiing");
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Crafts");
                                createOption("Golf");
                                createOption("Chess");
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Gymnastics");
                                createOption("Cycle");
                                createOption("Swimming");
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Surfing");
                                createOption("Hiking");
                                createOption("Video_Games");
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Volly_Ball");
                                createOption("Badminton");
                                createOption("Gym");
                                ?>
                                <div style="clear:both;"><div></div></div>
                                <?php
                                createOption("Parkour");
                                createOption("Fashion");
                                createOption("Yoga");
                                ?>
                                <div style="clear:both;"><div></div>
                                    <?php
                                    createOption("Basketball");
                                    createOption("Boxing");
                                    ?>
                            </fieldset>
                            <br>
                            <fieldset class="form-group">
                                <label for="uniqueHobbyLabel">Unique Hobby</label>
                                <input type="text"  name="Unique_Hobbie" class="form-control" maxlength="256"  placeholder="Enter  unique hobby"><br /><br>
                            </fieldset>
                        </div>
                        <div style="clear:both;"><div></div></div>
                    </div>
                    <br><br>
                    <input type="submit" name="Send" class="btn btn-primary" Value="Apply Changes">
                </form>


                <br><br>
                <br><br>
                </p>
            </div>
        </div>
    </div>

</div>
<?php include("includes/footer.html"); ?>
</body>

</html>