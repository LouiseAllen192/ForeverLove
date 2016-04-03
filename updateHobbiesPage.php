<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include($_SERVER['DOCUMENT_ROOT'].'/classes/UserServiceMgr.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/ReturnShortcuts.php');


    $uid = $_SESSION['user_id'];
    $displayForm = true;


    $update=false;
    $regOrUpdate = UserServiceMgr::determineUpdateOrReg($uid);
    if($regOrUpdate == "Update"){
        $update=true;
    }

    $dbvalue=array();
    if($update){
        $dbvalue = ReturnShortcuts::returnHobbies($uid);
    }


    $errors = array();
    if(!empty($_POST)) {
        $errors = UserServiceMgr::getHobbiesValidationErrors($_POST, $update);

        if($errors != false){
            foreach($errors as $k=>$v){
                echo $k.'---'.$v.'<br>';
            }
        }
    }



    if(!empty($_POST) && !$errors){
        $success = UserServiceMgr::updateUserHobbies($uid, $_POST);
    }

    if($update){
        $uniqueH = UserServiceMgr::getUniqueHobby($uid);
    }


    $hobbyNames = ReturnShortcuts::returnHobbyNames();
    ?>

    <title><?php echo $regOrUpdate?> Hobbies</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-update.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>



</head>

<body class="full">
<?php include("includes/navbar.php"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong><?php echo $regOrUpdate?> Hobbies</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <br>

                <?php
                if(!empty($_POST) && !$errors) {
                    $dbvalue = ReturnShortcuts::returnHobbies($uid);
                    if (!$update && $success) { $displayForm=false;?>
                        <div class= "alert alert-success" role="alert">
                        <a href="homePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Registration completed successfully.
                            <br><br><a href="homePage.php" class="btn btn-info center-block" style="width:200px;">Go to Home Page <span class="glyphicon glyphicon-home"></span></a>
                        </div>
                    <?php }
                    if ($update && $success) { $displayForm=false;?>
                        <div class= "alert alert-success" role="alert">
                        <a href="homePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Hobby Details updated successfully
                            <br><br><a href="homePage.php" class="btn btn-info center-block" style= "width:200px;" >Go to Home Page <span class="glyphicon glyphicon-home"></span></a>

                        </div>
                    <?php }
                    if (!$success) { ?>
                        <div class="alert alert-danger">
                        <a href="updateHobbiesPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error</strong> - Hobby details update was unsuccessful.
                            <br><br><a href="updateHobbiesPage.php" class="btn btn-info center-block" style= "width:200px;" >Try again <span class="glyphicon glyphicon-repeat"></span></a>

                        </div>
                    <?php }
                }
                ?>

                <?php if($displayForm){ ?>

                <form role ="form" class="form-inline" action="updateHobbiesPage.php" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            function createOption($name, $dbvalue, $regOrUpdate){
                                $html = '<div class="col-md-4"'.'>'.'<div class="form-group">'. '<label class="checkbox-inline">';
                                $html .= '<input type="checkbox" name="'.$name.'" id="'.$name.'"'.checked($name, $dbvalue,  $regOrUpdate).'>';
                                $html .= ucwords(str_replace('_', ' ', $name));
                                $html .= '</label></div></div>';
                                echo $html;
                            }

                            function checked($name, $dbvalue, $regOrUpdate){
                                if($regOrUpdate == "Register"){
                                    return '';
                                }
                                return ($dbvalue[$name] == 1 ? 'checked' : '');
                            }
                            ?>

                            <fieldset>
                                <?php
                                for($i=1; $i<count($hobbyNames)-1; $i++){
                                    createOption($hobbyNames[$i], $dbvalue, $regOrUpdate);
                                    if($i % 3 ==0){
                                        echo '<'.'div style="clear:both;"><div></div></div>';
                                    }
                                }
                                ?>
                            </fieldset>

                            <br>

                            <div class="form-group" id="unique_hobby_group">
                                <label for="unique_hobby" class="col-md-4 col-sm-5 control-label"><b>Unique Hobby</b></label>
                                <div class="col-md-8 col-sm-7">
                                    <input type="text" class="form-control" id="unique_hobby" name="unique_hobby" maxlength="256"
                                        <?php if ($update && Input::get('unique_hobby') != ''){
                                            echo 'value="'.Input::get('unique_hobby').'"';
                                        }
                                        if($update &&  Input::get('unique_hobby') == '' ) {
                                            echo 'value="'.$uniqueH.'"';
                                        }
                                        ?>
                                    >
                                </div>
                                <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                    <span class="<?php if($errors['unique_hobby'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                    <span class="<?php if($errors['unique_hobby'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, can only contain a-z, A-Z or whitespace</span>
                                </div>
                            </div>


                            <br><br><br>

                        </div>
                        <div style="clear:both;"><div></div></div>
                    </div>
                    <br><br>
                    <input type="submit" name="Send" class="btn btn-primary" Value="<?php echo $regOrUpdate?> Changes">
                </form>

                <?php } ?>


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
