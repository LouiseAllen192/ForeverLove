<!DOCTYPE html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");
    include($_SERVER['DOCUMENT_ROOT'].'/classes/User.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/ImageService.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/DB.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/Config.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/ReturnShortcuts.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/Input.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/UserServiceMgr.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/Validate.php');


    $uid;
    $admin = false;
    $update;
    $regOrUpdate;
    $unselected = false;

    if(isset($_GET['admin']) || isset($_POST['admin'])){
        $admin = true;
        $update = true;
        $regOrUpdate = "Update";
        if(isset($_GET['admin'])){$uid = $_GET['uid'];}
        if(isset($_POST['admin'])){$uid = $_POST['uid'];}
    }
    else{
        $uid = $_SESSION['user_id'];
        $update=false;
        $regOrUpdate = UserServiceMgr::determineUpdateOrReg($uid);
        if($regOrUpdate == "Update"){
            $update=true;
        }
    }


    $dbvalue=array();
    if($update){
        $dbvalue = ReturnShortcuts::returnPreferences($uid);
    }

    $errors = array();
    if(!empty($_POST)) {
        $errors = UserServiceMgr::getPreferencesValidationErrors($_POST, $update);
    }


    if(!empty($_POST) && !$errors){

        foreach($_POST as $k=>$v){
            if($v == 'Unselected'){
                $unselected = true;
            }
        }

        if(!$unselected) {
            $success = UserServiceMgr::updateUserPreferences($uid, $_POST, $regOrUpdate);

            if ($regOrUpdate == "Register" && $success) {
                header('Location: ' . 'updateHobbiesPage.php');
                die();
            }
        }
    }





    ?>

    <title><?php if($admin){echo 'Admin edit user';}else{echo $regOrUpdate;}?> Preferences</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-update.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">
    <script src="scripts/preferencesValidation.js"></script>
</head>

<body class="full">
<?php if($admin){include("includes/navbarAdmin.html");} else{include("includes/navbar.php");} ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong><?php if($admin){echo 'Admin edit user';}else{echo $regOrUpdate;}?> Preferences</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                    <br>
                    <?php

                    if($admin && empty($_POST)){ ?>
                    <div class="admin_notice">
                        <br><br><p>Admin has access to edit users preferences to remove offensive content. Review this page and edit accordingly </p><br><br>
                    </div><br><br><br>
                <?php }


                    if(!empty($_POST) && !$errors) {
                    if ($unselected) {?>
                        <div class="alert alert-danger">
                            <a href="UpdatePreferencesPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error</strong> - None of the options can be left as 'Unselected'. Please choose an option from the dropdown.
                        </div>
                        <?php
                    }
                    else {
                        if ($update && $success) {
                            $dbvalue = ReturnShortcuts::returnPreferences($uid); ?>
                            <div class="alert alert-success" role="alert">
                                <?php if($admin){ ?>
                                    <a href="../ForeverLove/secret_location/adminHomePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                               <?php } else{?>
                                <a href="homePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php } ?>
                                Preference Details updated successfully
                            </div>
                            <?php
                        }
                        if (!$success) { ?>
                            <div class="alert alert-danger">
                                <?php if($admin){ ?>
                                    <a href="UpdatePreferencesPage.php?admin=true&uid=<?php echo $uid;?>" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php } else{?>
                                    <a href="UpdatePreferencesPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php } ?>
                                <strong>Error</strong> - Preferences details update was unsuccessful
                                <?php if($admin){ ?>
                                    <a href="updatePreferencesPage.php?admin=true&uid=<?php echo $uid;?>" class="btn btn-info center-block" style= "width:200px;" >Try again <span class="glyphicon glyphicon-repeat"></span></a>
                                <?php } else{?>
                                    <a href="updatePreferencesPage.php" class="btn btn-info center-block" style= "width:200px;" >Try again <span class="glyphicon glyphicon-repeat"></span></a>
                                <?php }?>
                            </div>
                            <?php
                        }
                    }

                    }
                    ?>


                <form id="prefrences" action="updatePreferencesPage.php<?php if($admin) echo '?admin=true&uid='.$uid;?>" id="updateP" method="POST">
                    <div class="form-group" id="tag_line_group">
                        <label for="tag_line" class="col-md-4 col-sm-5 control-label"><b>Tag Line</b></label>
                        <div class="col-md-8 col-sm-7">
                            <input type="text" class="form-control" id="tag_line" name="tag_line" maxlength="256"
                                <?php if ($update && Input::get('tag_line') != ''){
                                    echo 'value="'.Input::get('tag_line').'"';
                                }
                                if($update &&  Input::get('tag_line') == '' ) {
                                    echo 'value="'.$dbvalue['tag_line'].'"';
                                }
                                ?>
                            >
                        </div>
                        <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                            <span class="<?php if($errors['tag_line'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                            <span class="<?php if($errors['tag_line'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, must be at least 2 characters. Valid characters are: (a-z, A-Z, 0-9, whitespace, ', -) </span>
                        </div>
                    </div>
                    <br><br><br>

                    <div class="form-group" id="city_group">
                        <label for="city" class="col-md-4 col-sm-5 control-label"><b>City </b></label>
                        <div class="col-md-8 col-sm-7">
                            <input type="text" class="form-control" id="city" name="city" maxlength="64"
                                <?php if ($update && Input::get('city') != ''){
                                echo 'value="'.Input::get('city').'"';
                            }
                            if($update &&  Input::get('city') == '' ) {
                                echo 'value="'.$dbvalue['city'].'"';
                            }
                            ?>
                            >
                        </div>
                        <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                            <span class="<?php if($errors['city'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                            <span class="<?php if($errors['city'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid format, must be at least 2 characters. Valid characters are: (a-z, A-Z, 0-9, whitespace, ', -)</span>
                        </div>
                    </div>

                    <br><br><br>



                    <fieldset class="form-group">
                        <?php

                        function generateSelect($name, $dbvalue, $regOrUpdate) {
                            if($regOrUpdate == "Update")$default= $dbvalue[$name];
                            else $default = "Unselected";
                            $options = ReturnShortcuts::returnOptionNames($name);
                            $html = '<fieldset class="form-group">';
                            $html .= '<label for="'.$name.'Label">'.ucwords(str_replace('_', ' ', $name)).'</label>';
                            $html .= '<select name="'.$name.'" class="form-control">';
                            foreach ($options as $option) {
                                if ($option == $default) {
                                    $html .= '<option selected="selected">'.$option.'</option>';
                                } else {
                                    $html .= '<option>'.$option.'</option>';
                                }
                            }
                            $html .= '</select><br><br></fieldset>';
                            echo $html;
                        }

                            $attributes = array("gender", "seeking", "intent", "height", "ethnicity", "body_type", "religion", "marital_status",
                                "income", "has_children", "wants_children", "smoker", "drinker" );

                            for($i=0; $i<count($attributes);$i++){
                                generateSelect($attributes[$i], $dbvalue, $regOrUpdate);
                            }
                        ?>


                        <div class="form-group" id="about_me_group">
                            <label for="about_me" class="col-md-4 col-sm-5 control-label"><b>About Me</b></label>
                            <div class="col-md-8 col-sm-7">
                                <textarea  class="form-control" name="about_me" id= "about_me" rows="5"><?php if(isset($dbvalue['about_me'])){ echo $dbvalue['about_me'];} ;?></textarea><br />
                            </div>
                            <div class="col-md-offset-4 col-sm-offset-5" id="errors">
                                <span class="<?php if($errors['about_me'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                <span class="<?php if($errors['about_me'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Invalid format, must be at least 2 characters. Valid characters are: (a-z, A-Z, 0-9, whitespace, ', -).</span>
                            </div>
                        </div>


                    <br><br>
                    <input type="submit" name="Send" class="btn btn-primary" Value="<?php echo $regOrUpdate;?> Changes">
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