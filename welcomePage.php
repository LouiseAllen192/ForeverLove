<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Welcome Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-welcome.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('a.login-window').click(function() {

                // Getting the variable's value from a link
                var loginBox = $(this).attr('href');

                //Fade in the Popup and add close button
                $(loginBox).fadeIn(300);

                //Set the center alignment padding + border
                var popMargTop = ($(loginBox).height() + 24) / 2;
                var popMargLeft = ($(loginBox).width() + 24) / 2;

                $(loginBox).css({
                    'margin-top' : -popMargTop,
                    'margin-left' : -popMargLeft
                });

                // Add the mask to body
                $('body').append('<div id="mask"></div>');
                $('#mask').fadeIn(300);

                return false;
            });

            // When clicking on the button close or the mask layer the popup closed
            $('a.close, #mask').live('click', function() {
                $('#mask , .login-popup').fadeOut(300 , function() {
                    $('#mask').remove();
                });
                return false;
            });
        });
    </script>

</head>

<body class="full">
    <?php include("includes/navbar.html"); ?>

    <!--Main page content-->

    <div class="row"><br><br></div>
    <div class="row"><br><br></div>
    <div class="row"><br><br></div>
    <div class="row"><br><br></div>
    <div class="row"><div class="col-md-2 col-sm-2 col-xs-8" id="lefttoc"></div>
    <div class="row">
        <div class="col-lg-8 col-md-4 col-sm-6 col-xs-12" id="centretoc">
            <div class="row">
                <div class="col-lg-8 col-md-11 col-sm-4 col-xs-12">
                    <div class="panel panel-primary panel-transparent">
                        <div class="panel-body"><p>Find your Forever Love today! <br><br><br> Sign in to meet your perfect match<br><br>
                                Not already a member? <br>Register now for a FREE 30 day trial<br><br><br><br></p>


                            <a href="#login-box" class="btn btn-info center-block login-window">Sign in</a><br>
                            <a href="#" class="btn btn-info center-block" role="button">Register</a>

                            <div id="login-box" class="login-popup">
                                <a href="#" class="close"><img src="includes/pics/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
                                <form method="post" class="signin" action="#">
                                    <fieldset class="textbox">
                                        <label class="username">
                                            <span>Username</span>
                                            <input id="username" name="username" value="" type="text" autocomplete="on" placeholder="Username">
                                        </label>

                                        <label class="password">
                                            <span>Password</span>
                                            <input id="password" name="password" value="" type="password" placeholder="Password">
                                        </label>

                                        <button class="submit button" type="button">Sign in</button>

                                        <p>
                                            <a class="forgot" href="#">Forgot your password?</a>
                                        </p>
                                    </fieldset>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
