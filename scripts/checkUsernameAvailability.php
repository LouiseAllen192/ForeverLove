<?php
include '../core/init.php';
include '../classes/DB.php';
include '../classes/Config.php';

if(isset($_POST['Username'])){
    $username = $_POST['Username'];
    echo DB::getInstance()->get('registration_details', ['Username', '=', $username])->count();
}
else{
    echo 1;
}
?>