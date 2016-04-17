<?php
require_once 'core/init.php';

$seed = (isset($_GET['seed'])) ? $_GET['seed'] : 26;
(new PopulateDB())->populateDatabase($seed);
if(($seed += 50) < 1000){
    header('Location: populateDatabaseScript.php?seed='.$seed);
    die();
}
?>