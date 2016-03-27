<?php
if(!isset($_SESSION['permissions'])){
    session_start();
    $_SESSION['permissions'] = 'user';
}

//Global configuration settings array for easy access
$GLOBALS['config'] = [
    'mysql' => [
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'group13db'
    ]
];


if($_SESSION['permissions'] == 'admin'){
    spl_autoload_register(function($class){
        require_once '../classes/'.$class.'.php';
    });
}
else if($_SESSION['permissions'] == 'user'){
    spl_autoload_register(function($class){
        require_once 'classes/'.$class.'.php';
    });
}
?>