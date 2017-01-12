<?php

/**
 * Created by PhpStorm.
 * User: alto
 * Date: 1/12/17
 * Time: 11:28 AM
 */
class Configuration
{
    public static function is_selenium_running(){
        $selenium_running = false;

        $fp = @fsockopen('localhost', 4444);
        if ($fp !== false) {
            $selenium_running = true;
            fclose($fp);
        }
        return $selenium_running;
    }

    public static function get_config($name){
        $config = json_decode(file_get_contents('config.json'), true);
        return $config[$name];
    }
}