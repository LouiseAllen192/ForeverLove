<?php
class Config{
    /*
     * Access the GLOBALS config array using a directory path
     * (easier to remember eg. Config::get(session/username)
     */
    public static function get($path = null){
        if($path){
            $config = $GLOBALS['config'];
            $path = explode('/', $path);

            foreach ($path as $bit) {
                if(isset($config[$bit]))
                    $config = $config[$bit];
            }
            return $config;
        }
        return false;
    }
}
