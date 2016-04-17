<head>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="bootstrap_js/jquery.js"></script>
    <script src="bootstrap_js/bootstrap.js"></script>
    <script src="scripts/search.js"></script>

    <?php
    if(isset($_GET['search_submit_button'])){
        header('Location: searchResultsPage.php?searchTerm='.$_GET['input_search']);
        die();
    }

    $browser = BrowserHelper::getBrowser($_SERVER['HTTP_USER_AGENT']);
    ?>
</head>

<nav class="navbar navbar-inverse navbar-fixed-top navBar" role="navigation">
    <div class="container">
        <div class = "row">

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                <div class="col-md-2 col-sm-2 pull-left">
                    <img src="includes/pics/logo.jpg">
                </div>
            </div>



            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-3">
                <div class="searchbar-area">
                    <form class="navbar-form" role="search">
                        <div class="input-group" <?php if($browser == 'MF') echo 'style="width: 260px"';?> >
                            <div class="search-bar " id="search_group">
                                <input type="text" class="form-control search" placeholder="Search for..." id="input_search" name="input_search" title="Search username, unique hobby and city">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" id="search_submit_button" name="search_submit_button" type="submit" title="Search username, unique hobby and city">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                                <div id="search_result" class="hide"></div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>



            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-4">
                <div style="padding-top: 34px">
                    <?php
                        if(isset($_SESSION['user_id'])) {
                            $userID = $_SESSION['user_id'];
                            $newMessages = DB::getInstance()->query("SELECT COUNT(*) as Number FROM messages WHERE recipient_id = '$userID' AND seen = '0'")->results();
                            $count = $newMessages[0]->Number;
                            if ($count > 0)
                                echo "<a href=\"existingConversationPage.php\"><button type=\"button\" class=\"btn btn-primary\" id=\"new_msg_button\"><span class=\"glyphicon glyphicon-envelope\">  </span><span class=\"badge\">$count</span></button></a>";
                        }
                    ?>
                </div>
            </div>


            <div class="col-lg-5 col-md-5 col-sm-10 col-xs-6">

                <!--displays logged in username-->
                <div class = "logged-in pull-right">
                    Logged in as:
                    <?php
                        if(isset($_SESSION['user_id'])){
//                            echo 'SESSION:'.$_SESSION['user_id'];
                             $log =  UserServiceMgr::getUsername($_SESSION['user_id']).'   ';
                        }else{
                              $log = 'UNSET';
                        } echo $log?>

                    <?php echo '<a href="../ForeverLove/welcomePage.php?logout=yes"><span class="glyphicon glyphicon-log-out" tooltip = "popover"  title = "Logout"></span></a>';?>
                </div>


                <!-- This changes the nav bar to a small icon for mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class = "nav-text pull-right">
                    <ul class="pull-right">
                        <li>
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav navbar-right ">
                                    <li><a href="../ForeverLove/homePage.php">Home</a></li>
                                    <li><a href="../ForeverLove/settingsPage.php">Settings</a></li>
                                    <li><a href="../ForeverLove/contactPage.php">Contact</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>


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

