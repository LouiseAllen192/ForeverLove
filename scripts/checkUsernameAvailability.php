<?php
include '../core/init.php';
include '../classes/DB.php';
include '../classes/Config.php';

if(isset($_POST['username'])){
    $uid = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;
    $username = $_POST['username'];
    echo DB::getInstance()->query("SELECT user_id FROM registration_details WHERE username = '$username' && user_id != '$uid'")->count();
}
else{
    echo 1;
}
?>