<?php
session_start();

//Global configuration settings array for easy access
$GLOBALS['config'] = [
    'mysql' => [
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'group13db'
    ]
];


//Autoloads class as required
spl_autoload_register(function($class){
    require_once 'classes/'.$class.'.php';
});
