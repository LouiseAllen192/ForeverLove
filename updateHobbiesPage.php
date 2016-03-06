<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>

    <title>Update Hobbies</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>



    <?php

    // All to be uncommented and used when database is working/populated

//    $uid = 001; //needs to be got through global data possibly???
//
//    $hobbies = DB::getInstance()->get('hobbies', ['User_id', '=', $uid])->results()[0];
//    $dbvalue = array("Reading"=>$hobbies->Reading, "Cinema"=>$hobbies->Cinema, "Shopping"=>$hobbies->Shopping,
//    "Socializing"=>$hobbies->Socializing, "Travelling"=>$hobbies->Travelling, "Walking"=>$hobbies->Walking,
//        "Exercise"=>$hobbies->Exercise, "Soccer"=>$hobbies->Soccer, "Dance"=>$hobbies->Dance,
//        "Horses"=>$hobbies->Horses, "Painting"=>$hobbies->Painting, "Running"=>$hobbies->Running,
//        "Eating_Out"=>$hobbies->Eating_Out, "Cooking"=>$hobbies->Cooking, "Computers"=>$hobbies->Computers,
//        "Bowling"=>$hobbies->Bowling, "Writing"=>$hobbies->Writing, "Skiing"=>$hobbies->Skiing,
//        "Crafts"=>$hobbies->Crafts, "Golf"=>$hobbies->Golf, "Chess"=>$hobbies->Chess,
//        "Gymnastics"=>$hobbies->Gymnastics, "Cycle"=>$hobbies->Cycle, "Swimming"=>$hobbies->Swimming,
//        "Surf"=>$hobbies->Surfing, "Hiking"=>$hobbies->Hiking, "Video_Games"=>$hobbies->Video_Games,
//        "Volly_ball"=>$hobbies->Volly_Ball, "Badminton"=>$hobbies->Badminton, "Gym"=>$hobbies->Gym,
//        "Parkour"=>$hobbies->Parkour, "Fashion"=>$hobbies->Fashion, "Yoga"=>$hobbies->Yoga,
//        "Basketball"=>$hobbies->Basketball, "Boxing"=>$hobbies->Boxing, "Unique_Hobbie"=>$hobbies->Unique_Hobbie);


    //hardcoded array to be replaced with users values from db
    $dbvalue = array("Reading"=>"0", "Cinema"=>"0", "Shopping"=>"0", "Socializing"=>"1", "Travelling"=>"0", "Walking"=>"1",
        "Exercise"=>"1", "Soccer"=>"0", "Dance"=>"1", "Horses"=>"1", "Painting"=>"0", "Running"=>"0",
        "Eat_Out"=>"0", "Cooking"=>"0", "Computers"=>"0", "Bowling"=>"1", "Writing"=>"0", "Skiing"=>"1",
        "Crafts"=>"1", "Golf"=>"1", "Chess"=>"1", "Gymnastics"=>"1", "Cycle"=>"1", "Swimming"=>"1",
        "Surfing"=>"1", "Hiking"=>"0", "Video_Games"=>"1", "Volly_Ball"=>"1", "Badminton"=>"1", "Gym"=>"1",
        "Parkour"=>"0", "Fashion"=>"1", "Yoga"=>"1", "Basketball"=>"0", "Boxing"=>"0", "Unique_Hobbie"=>"Cutting Turf");
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
                        <strong>Update Hobbies</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <br>



                <form role ="form" class="form-inline" action="updateHobbies.php" method="get">
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Reading" id="readingCheckbox" <?php echo ($dbvalue['Reading']==1 ? 'checked' : '');?> >Reading
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Cinema" id="cinemaCheckbox" <?php echo ($dbvalue['Cinema']==1 ? 'checked' : '');?> >Cinema
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Shopping" id="shoppingCheckbox" <?php echo ($dbvalue['Shopping']==1 ? 'checked' : '');?> >Shopping
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="checkbox-inline">
                                           <input type="checkbox" name="Socializing" id="socializingCheckbox" <?php echo ($dbvalue['Socializing']==1 ? 'checked' : '');?> >Socializing
                                       </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Travelling" id="travellingCheckbox" <?php echo ($dbvalue['Travelling']==1 ? 'checked' : '');?> >Travelling
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Walking" id="walkingCheckbox" <?php echo ($dbvalue['Walking']==1 ? 'checked' : '');?> >Walking
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Exercise" id="exerciseCheckbox" <?php echo ($dbvalue['Exercise']==1 ? 'checked' : '');?> >Exercise
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Soccer" id="soccerCheckbox" <?php echo ($dbvalue['Soccer']==1 ? 'checked' : '');?> >Soccer
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Dance" id="DancingCheckbox" <?php echo ($dbvalue['Dance']==1 ? 'checked' : '');?> >Dancing
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Horses" id="horsesCheckbox" <?php echo ($dbvalue['Horses']==1 ? 'checked' : '');?> >Horses
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Painting" id="paintingCheckbox" <?php echo ($dbvalue['Painting']==1 ? 'checked' : '');?> >Painting
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Running" id="runningCheckbox" <?php echo ($dbvalue['Running']==1 ? 'checked' : '');?> >Running
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Eat_Out" id="eatingOutCheckbox" <?php echo ($dbvalue['Eat_Out']==1 ? 'checked' : '');?> >Eating Out
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Cooking" id="cookingCheckbox" <?php echo ($dbvalue['Cooking']==1 ? 'checked' : '');?> >Cooking
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Computers" id="computersCheckbox" <?php echo ($dbvalue['Computers']==1 ? 'checked' : '');?> >Computers
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Bowling" id="bowlingCheckbox" <?php echo ($dbvalue['Bowling']==1 ? 'checked' : '');?> >Bowling
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Writing" id="writingCheckbox" <?php echo ($dbvalue['Writing']==1 ? 'checked' : '');?> >Writing
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Skiing" id="skiingCheckbox" <?php echo ($dbvalue['Skiing']==1 ? 'checked' : '');?> >Skiing
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Crafts" id="craftsCheckbox" <?php echo ($dbvalue['Crafts']==1 ? 'checked' : '');?> >Crafts
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Golf" id="golfCheckbox" <?php echo ($dbvalue['Golf']==1 ? 'checked' : '');?> >Golf
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Chess" id="chessCheckbox" <?php echo ($dbvalue['Chess']==1 ? 'checked' : '');?> >Chess
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Gymnastics" id="gymnasticsCheckbox" <?php echo ($dbvalue['Gymnastics']==1 ? 'checked' : '');?> >Gymnastics
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Cycle" id="cyclingCheckbox" <?php echo ($dbvalue['Cycle']==1 ? 'checked' : '');?> >Cycling
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Swimming" id="swimmingCheckbox" <?php echo ($dbvalue['Swimming']==1 ? 'checked' : '');?> >Swimming
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Surfing" id="surfingCheckbox" <?php echo ($dbvalue['Surfing']==1 ? 'checked' : '');?> >Surfing
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Hiking" id="hikingCheckbox" <?php echo ($dbvalue['Hiking']==1 ? 'checked' : '');?> >Hiking
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Video_Games" id="videoGamesCheckbox" <?php echo ($dbvalue['Video_Games']==1 ? 'checked' : '');?> >Video Games
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Volly_Ball"" id="volleyballCheckbox" <?php echo ($dbvalue['Volly_Ball']==1 ? 'checked' : '');?> >Volleyball
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Badminton" id="badmintonCheckbox" <?php echo ($dbvalue['Badminton']==1 ? 'checked' : '');?> >Badminton
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Gym" id="gymCheckbox" <?php echo ($dbvalue['Gym']==1 ? 'checked' : '');?> >Gym
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Parkour" id="parkourCheckbox" <?php echo ($dbvalue['Parkour']==1 ? 'checked' : '');?> >Parkour
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Fashion" id="fashionCheckbox" <?php echo ($dbvalue['Fashion']==1 ? 'checked' : '');?> >Fashion
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Yoga" id="yogaCheckbox" <?php echo ($dbvalue['Yoga']==1 ? 'checked' : '');?> >Yoga
                                        </label>
                                    </div>
                                </div>
                                <div style="clear:both;"><div></div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Basketball" id="basketballCheckbox" <?php echo ($dbvalue['Basketball']==1 ? 'checked' : '');?> >Basketball
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="Boxing" id="boxingCheckbox" <?php echo ($dbvalue['Boxing']==1 ? 'checked' : '');?> >Boxing
                                        </label>
                                    </div>
                                </div>

                            </fieldset>
                            <br>
                            <fieldset class="form-group">
                                <label for="uniqueHobbyLabel">Unique Hobby</label>
                                <input type="text"  name="Unique_Hobbie" class="form-control" maxlength="256"  placeholder="Enter new unique hobby"><br /><br>
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