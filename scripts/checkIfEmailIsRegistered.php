<?php
include '../core/init.php';
include '../classes/DB.php';
include '../classes/Config.php';

if(isset($_POST['email'])){
    $uid = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;
    $email = $_POST['email'];
    echo DB::getInstance()->query("SELECT user_id FROM registration_details WHERE email = '$email' && user_id != '$uid'")->count();
}
else{
    echo 1;
}
?>