<head>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="bootstrap_js/jquery.js"></script>
    <script src="bootstrap_js/bootstrap.js"></script>
    <script src="scripts/search.js"></script>

<!--    --><?php //$_SESSION['user_id'] = 5;?>
</head>

<nav class="navbar navbar-inverse navbar-fixed-top navBar" role="navigation">
    <div class="container">

        <div class = "row">

            <div class="col-md-2">

                <div class="col-md-2 col-sm-2 pull-left">
                    <img src="includes/pics/logo.jpg">
                </div>

            </div>

            <div class="col-md-5">

                <!-- This changes the nav bar to a small icon for mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!--searchbar area-->
                <div class="searchbar-area">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <div class="search-bar" id="search_group">
                                <input type="text" class="form-control search" placeholder="Search" id="input_search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                                <div id="search_result"></div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>


            <div class="col-md-5">
                <div>
                    <?php
                        if(isset($_SESSION['user_id']))
                             $userID =  UserServiceMgr::getUsername($_SESSION['user_id']).'   ';
                        else
                              $userID = 1; //$_SESSION['user_id'];
                        $newMessages = DB::getInstance()->query("SELECT COUNT(*) as Number FROM messages WHERE recipient_id = '$userID' AND seen = '0'")->results();
                        $count = $newMessages[0]->Number;
                        if($count > 0)
                            echo "<a href=\"existingConversationPage.php\"><button type=\"button\" class=\"btn btn-primary\">New Messages<span class=\"badge\">$count</span></button></a>";
                    ?>
                </div>
            </div>
                <!--displays logged in username-->
                <div class = "logged-in pull-right">
                    Logged in as:
                    <?php
                        if(isset($_SESSION['user_id'])){
                             $log =  UserServiceMgr::getUsername($_SESSION['user_id']).'   ';
                        }else{
                              $log = 'UNSET';
                        } echo $log?>

                    <?php echo '<a href="../ForeverLove/welcomePage.php?logout=yes"><span class="glyphicon glyphicon-log-out" tooltip = "popover"  title = "Logout"></span></a>';?>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class = "nav-text">
                    <ul class="pull-right">
                        <li>
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav navbar-right ">
                                    <li>
                                        <a href="../ForeverLove/homePage.php">Home</a>
                                    </li>
                                    <li>
                                        <a href="../ForeverLove/settingsPage.php">Settings</a>
                                    </li>
                                    <li>
                                        <a href="../ForeverLove/contactPage.php">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>


        </div>


        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

    </div>
</nav>

