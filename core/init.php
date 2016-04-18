<?php
session_start();

//// GLOBALS for localhost
$GLOBALS['config'] = [
    'mysql' => [
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'group13db'
    ]
];

// GLOBALS for csis server
//$GLOBALS['config'] = [
//    'mysql' => [
//        'host' => '193.1.101.7',
//        'username' => 'group13',
//        'password' => 'mb4P8WhVl',
//        'db' => 'group13db',
//        'port' => 3307
//    ]
//];

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