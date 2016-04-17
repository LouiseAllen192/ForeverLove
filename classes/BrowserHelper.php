<?php


class BrowserHelper
{

    public static function getBrowser($browserInfo){
        if(strpos($browserInfo, 'MSIE') !== FALSE)
            $browser='IE';
        elseif(strpos($browserInfo, 'Trident') !== FALSE) //For Supporting IE 11
            $browser='IE';
        elseif(strpos($browserInfo, 'Firefox') !== FALSE)
            $browser='MF';
        elseif(strpos($browserInfo, 'Chrome') !== FALSE)
            $browser='GC';
        elseif(strpos($browserInfo, 'Opera Mini') !== FALSE)
            $browser="OM";
        elseif(strpos($browserInfo, 'Opera') !== FALSE)
            $browser="O";
        elseif(strpos($browserInfo, 'Safari') !== FALSE)
            $browser="S";
        else
            $browser= 'Something else';

        return $browser;

    }
}