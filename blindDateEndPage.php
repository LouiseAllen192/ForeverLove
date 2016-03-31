<!DOCTYPE html>
<html>

<head>

    <?php
    require_once 'core/init.php';
    include("includes/metatags.html");
    ?>
    <title>Blind Date Termination</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-base-page.css" rel="stylesheet">
    <?php include("includes/fonts.html"); ?>
    <?php
        if(!empty($_POST))
        {
            $convo_id = $_POST['convo_id'];
            DB::getInstance()->query("DELETE FROM conversations where conversation_id = '$convo_id'");
        }
    ?>


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
                        <strong>Conversation Ended</strong>
                    </small>
                </h2>
                <hr class="tagline-divider">
                <p>

                    <br><br>
                    There's plenty more fish in the sea, why not try again?
                    <br><br>
                    <form action="blindDatePage.php" method="post">
                        <button name="BD" value="BD" class="btn btn-warning">Find New Blind Date!</button>
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