<?php
session_start();

$GLOBALS['config'] = [
    'mysql' => [
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'group13db'
    ]
];


if((isset($_SESSION['permissions']) && $_SESSION['permissions'] == 'admin') || (isset($GLOBALS['adminLogin']) && $GLOBALS['adminLogin'])){
    spl_autoload_register(function($class){
        require_once '../classes/'.$class.'.php';
    });
}
else{
    spl_autoload_register(function($class){
        require_once 'classes/'.$class.'.php';
    });
}
?>