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
    ?>
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


            </div>




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


        </div>


    </div>


    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    </div>
</nav>

