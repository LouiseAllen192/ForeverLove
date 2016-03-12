<?php
require_once 'core/init.php';

if(isset($_POST['Email'])){
    $email = $_POST['Email'];
    echo DB::getInstance()->get('registration_details', ['Email', '=', $email])->count();
}
else{
    echo 1;
}
?>