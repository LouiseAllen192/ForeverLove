<?php
require_once 'core/init.php';

if(isset($_POST['Username'])){
    $username = $_POST['Username'];
    echo DB::getInstance()->get('registration_details', ['Username', '=', $username])->count();
}
else{
    echo 1;
}
?>