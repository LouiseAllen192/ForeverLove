<?php
include '../core/init.php';
include '../classes/DB.php';
include '../classes/Config.php';

if(isset($_POST['username'])){
    $username = $_POST['username'];
    echo DB::getInstance()->get('registration_details', ['username', '=', $username])->count();
}
else{
    echo 1;
}
?>