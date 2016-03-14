<!DOCTYPE html>
<head>
    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    include("includes/fonts.html");

    $errors = [];

    if(Input::exists()){
        $validate = new Validate();
        $validate->check($_POST, [
            'Email' => [
                'required' => true,
                'matches' => '/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/',
                'unique' => 'registration_details'
            ],
            'Confirm_Email' => [
                'required' => true,
                'matches' => '/\b('.$_POST['Email'].')\b/'
            ],
            'Username' => [
                'required' => true,
                'matches' => '/^[a-zA-Z0-9_-]{3,32}$/',
                'unique' => 'registration_details'
            ],
            'First_Name' => [
                'required' => true,
                'matches' => '/^[a-zA-Z]{2,32}$/'
            ],
            'Last_Name' => [
                'required' => true,
                'matches' => '/^[a-zA-Z\'-]{2,32}$/'
            ],
            'Password' => [
                'required' => true,
                'matches' => '/^[a-zA-Z0-9_-]{6,32}$/',
            ],
            'Confirm_Password' => [
                'required' => true,
                'matches' => '/\b('.$_POST['Password'].')\b/'
            ]
        ]);

        if($validate->passed()){
            $db = DB::getInstance();
            $db->registerUser('registration_details', ['Username' => $_POST['Username'], 'Password' => $_POST['Password'], 'First_Name' => $_POST['First_Name'], 'Last_Name' => $_POST['Last_Name'], 'Email' => $_POST['Email']]);
            $GLOBALS['config']['session']['user_id'] = $db->get('registration_details', ['Username' , '=', $_POST['Username']])->results()[0]->User_id;
            header('Location: '.'registerPreferencesPage.php');
            die();
        }
        else{
            $errors = $validate->getErrors();
        }
    }
    ?>

    <title>Registration Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <link href="css/custom-form-page.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="scripts/registrationValidation.js"></script>
</head>

<body class="full">
<?php include("includes/navbarNotLoggedIn.html"); ?>

<!--Main page content-->

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <br><br>
                <h2>
                    <small>
                        <strong>Please Complete Registration</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>
                    <br>

                <form id="RegForm" class="form-horizontal" role="form" method="post">
                    <fieldset>
                        <div class="form-group" id="Email_Group">
                            <label for="Email" class="col-lg-4 col-md-4 col-sm-5 control-label"><b>Email</b></label>
                            <div class="col-lg-8 col-md-8 col-sm-7">
                                <input type="email" class="form-control" id="Email" name="Email" maxlength="128" value="<?php echo Input::get('Email');?>">
                            </div>
                            <p class="col-lg-4 col-md-4 col-sm-5"></p>
                            <span class="<?php if($errors['Email'] == 'Error_Required') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Required">Required...</span>
                            <span class="<?php if($errors['Email'] == 'Error_Regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Regex">Invalid format, e.g. kevin@example.com</span>
                            <span class="<?php if($errors['Email'] == 'Error_Unique') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Unique">Email address is already registered...</span>
                        </div>

                        <div class="form-group" id="Confirm_Email_Group">
                            <label for="Confirm_Email" class="col-lg-4 col-md-4 col-sm-5 control-label"><b>Confirm Email</b></label>
                            <div class="col-lg-8 col-md-8 col-sm-7">
                                <input type="email" class="form-control" id="Confirm_Email" name="Confirm_Email" maxlength="128" value="">
                            </div>
                            <p class="col-lg-4 col-md-4 col-sm-5"></p>
                            <span class="<?php if($errors['Confirm_Email'] == 'Error_Required') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Required">Required...</span>
                            <span class="<?php if($errors['Confirm_Email'] == 'Error_Regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Regex">Email addresses do not match...</span>
                        </div>

                        <div class="form-group" id="Username_Group">
                            <label for="Username" class="col-lg-4 col-md-4 col-sm-5 control-label"><b>Username</b></label>
                            <div class="col-lg-8 col-md-8 col-sm-7">
                                <input type="text" class="form-control" id="Username" name="Username" maxlength="32" value="<?php echo Input::get('Username');?>">
                            </div>
                            <p class="col-lg-4 col-md-4 col-sm-5"></p>
                            <span class="<?php if($errors['Username'] == 'Error_Required') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Required">Required...</span>
                            <span class="<?php if($errors['Username'] == 'Error_Regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Regex">Invalid username, 3 - 32 characters(a-zA-Z0-9_-) only...</span>
                            <span class="<?php if($errors['Username'] == 'Error_Unique') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Unique">Username already in use...</span>
                        </div>

                        <div class="form-group" id="First_Name_Group">
                            <label for="First_Name" class="col-lg-4 col-md-4 col-sm-5 control-label"><b>First Name</b></label>
                            <div class="col-lg-8 col-md-8 col-sm-7">
                                <input type="text" class="form-control" id="First_Name" name="First_Name" maxlength="32" value="<?php echo Input::get('First_Name');?>" autocomplete="on">
                            </div>
                            <p class="col-lg-4 col-md-4 col-sm-5"></p>
                            <span class="<?php if($errors['First_Name'] == 'Error_Required') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Required">Required...</span>
                            <span class="<?php if($errors['First_Name'] == 'Error_Regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Regex">Invalid format, 2 - 32 characters(a-zA-Z) only...</span>
                        </div>

                        <div class="form-group" id="Last_Name_Group">
                            <label for="Last_Name" class="col-lg-4 col-md-4 col-sm-5 control-label"><b>Last Name</b></label>
                            <div class="col-lg-8 col-md-8 col-sm-7">
                                <input type="text" class="form-control" id="Last_Name" name="Last_Name" maxlength="32" value="<?php echo Input::get('Last_Name');?>" autocomplete="on">
                            </div>
                            <p class="col-lg-4 col-md-4 col-sm-5"></p>
                            <span class="<?php if($errors['Last_Name'] == 'Error_Required') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Required">Required...</span>
                            <span class="<?php if($errors['Last_Name'] == 'Error_Regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Regex">Invalid format, 2 - 32 characters(a-zA-Z'-) only...</span>
                        </div>

                        <div class="form-group" id="Password_Group">
                            <label for="Password" class="col-lg-4 col-md-4 col-sm-5 control-label"><b>Password</b></label>
                            <div class="col-lg-8 col-md-8 col-sm-7">
                                <input type="password" class="form-control" maxlength="32" id="Password" name="Password" value="">
                            </div>
                            <p class="col-lg-4 col-md-4 col-sm-5"></p>
                            <span class="<?php if($errors['Password'] == 'Error_Required') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Required">Required...</span>
                            <span class="<?php if($errors['Password'] == 'Error_Regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Regex">Invalid format, 6 - 32 characters(a-zA-Z0-9_-) only...</span>
                        </div>

                        <div class="form-group" id="Confirm_Password_Group">
                            <label for="Confirm_Password" class="col-lg-4 col-md-4 col-sm-5 control-label"><b>Confirm Password</b></label>
                            <div class="col-lg-8 col-md-8 col-sm-7">
                                <input type="password" class="form-control" maxlength="32" id="Confirm_Password" name="Confirm_Password" value="">
                            </div>
                            <p class="col-lg-4 col-md-4 col-sm-5"></p>
                            <span class="<?php if($errors['Confirm_Password'] == 'Error_Required') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Required">Required...</span>
                            <span class="<?php if($errors['Confirm_Password'] == 'Error_Regex') : ?>error<?php else : ?>hide<?php endif; ?>" id="Error_Regex">Passwords do not match...</span>
                        </div>
                    </fieldset>
                    <br><br>
                    <a href="welcomePage.php" class="btn btn-info center-inline" role="button">Return</a>
                    <input class="btn btn-info center-inline" id="Continue_Button" type="submit" value="Continue">
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
