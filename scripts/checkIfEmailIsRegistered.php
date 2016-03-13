<?php
include '../core/init.php';
include '../classes/DB.php';
include '../classes/Config.php';

if(isset($_POST['Email'])){
    $email = $_POST['Email'];
    echo DB::getInstance()->get('registration_details', ['Email', '=', $email])->count();
}
else{
    echo 1;
}
?>