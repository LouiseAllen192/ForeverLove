<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $_SESSION['user_id'] = 1;
    $reportee = 5;//$_GET['uid'];

    $db = DB::getInstance();
    $username = $db->query("SELECT username FROM registration_details WHERE user_id = '$reportee'")->results()[0]->username;
    $priorities = SearchServiceMgr::getChoices('priority');

    if(isset($_POST['submit_button']) && !($errors = UserServiceMgr::validateReport($_POST))){
        UserServiceMgr::addReport($reportee, $_POST);
    }
    ?>

    <title>Report User</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <script src="bootstrap_js/jquery.js"></script>
    <script src="scripts/reportUser.js"></script>

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
                <h2>
                    <small>
                        <strong>Report <?php echo $username;?></strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <br>

                <?php
                if(Input::exists()){
                    if(!$errors){?>
                        <div class= "alert alert-success" role="alert">
                            <a href="homePage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            Successfully reported <?php echo $username;?> to administration
                        </div>
                        <?php
                    }
                    else{?>
                        <div class="alert alert-danger">
                            <a href="settingsPage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error</strong> - Report submission was unsuccessful
                        </div>
                        <?php
                    }
                }
                ?>

                <form class="form-horizontal" role="form" method="post">

                    <div class="row">
                        <p class="col-md-2 col-xs-1"></p>
                        <div class="col-md-8 col-xs-10">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Please leave a detailed description:
                                </div>
                                <div class="panel-body">

                                    <div class="col-sm-6 col-xs-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                Priority
                                            </div>
                                            <div class="panel-body">
                                                <select class="form-control" name="priority">
                                                    <option disabled selected>Choose Priority</option>
                                                <?php
                                                foreach($priorities as $priority => $value){?>
                                                    <option value="<?php echo $priority;?>"><?php echo $value;?></option>;
                                                    <?php
                                                }?>
                                                </select>
                                            </div>
                                            <span class="<?php if($errors['priority'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12">
                                        <div class="panel panel-primary" title="Share conversations between you and <?php echo $username;?> with administration.">
                                            <div class="panel-heading">
                                                Share Conversations
                                            </div>
                                            <div class="panel-body">
                                                <select class="form-control" name="view_conversation">
                                                    <option selected value="0">Don't allow</option>
                                                    <option value="1">Allow</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <textarea class="form-control" id="content" onkeyup="filter('content')" onkeydown="filter('content')" name="content" style="height: 250px;" placeholder="Detailed information here..."><?php echo Input::get('content');?></textarea>
                                        <span class="<?php if($errors['content'] == 'error_required') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_required">Required...</span>
                                        <span class="<?php if($errors['content'] == 'error_regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="error_regex">Invalid characters...</span>
                                    </div>
                                </div>
                            </div>
                            <input class="btn btn-info center-inline" id="submit_button" name="submit_button" type="submit" value="Submit Report">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <?php include("includes/footer.html"); ?>
</body>

</html>