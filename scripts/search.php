<?php
include '../core/init.php';
include '../classes/DB.php';
include '../classes/Config.php';
include '../classes/SearchServiceMgr.php.php';

if(isset($_POST['searchTerm'])){
    $term = $_POST['searchTerm'];
    $sql = "SELECT user_id";
}
?>