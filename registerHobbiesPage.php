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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Reading" id="readingCheckbox" >Reading
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Cinema" id="cinemaCheckbox" >Cinema
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Shopping" id="shoppingCheckbox" >Shopping
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Socializing" id="socializingCheckbox" >Socializing
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Travelling" id="travellingCheckbox" >Travelling
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Walking" id="walkingCheckbox">Walking
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Exercise" id="exerciseCheckbox" >Exercise
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Soccer" id="soccerCheckbox" >Soccer
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Dance" id="DancingCheckbox" >Dancing
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Horses" id="horsesCheckbox" >Horses
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Painting" id="paintingCheckbox" >Painting
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Running" id="runningCheckbox" >Running
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Eat_Out" id="eatingOutCheckbox" >Eating Out
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Cooking" id="cookingCheckbox" >Cooking
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Computers" id="computersCheckbox" >Computers
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Bowling" id="bowlingCheckbox" >Bowling
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Writing" id="writingCheckbox" >Writing
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Skiing" id="skiingCheckbox" >Skiing
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Crafts" id="craftsCheckbox" >Crafts
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Golf" id="golfCheckbox" >Golf
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Chess" id="chessCheckbox" >Chess
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Gymnastics" id="gymnasticsCheckbox" >Gymnastics
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Cycle" id="cyclingCheckbox">Cycling
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Swimming" id="swimmingCheckbox" >Swimming
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Surfing" id="surfingCheckbox">Surfing
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Hiking" id="hikingCheckbox" >Hiking
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Video_Games" id="videoGamesCheckbox" >Video Games
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Volly_Ball"" id="volleyballCheckbox" >Volleyball
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Badminton" id="badmintonCheckbox" >Badminton
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Gym" id="gymCheckbox" >Gym
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Parkour" id="parkourCheckbox" >Parkour
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Fashion" id="fashionCheckbox" >Fashion
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Yoga" id="yogaCheckbox">Yoga
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Basketball" id="basketballCheckbox"  >Basketball
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Boxing" id="boxingCheckbox" >Boxing
                                        </label>
                                    </div>
                                </div>

                            </fieldset>
                            <br>
                            <fieldset class="form-group">
                                <label for="uniqueHobbyLabel">Unique Hobby</label>
                                <input type="text"  name="Unique_Hobbie" class="form-control" maxlength="256"  placeholder="Enter unique hobby"><br /><br>
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