<?php
include '../core/init.php';
include '../classes/DB.php';
include '../classes/Config.php';

if(isset($_POST['email'])){
    $email = $_POST['email'];
    echo DB::getInstance()->get('registration_details', ['email', '=', $email])->count();
}
else{
    echo 1;
}
?>