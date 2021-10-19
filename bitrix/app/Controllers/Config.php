<?php

namespace App\Controllers;

class Config
{
    public static function get($path)
    {
        $group = explode("/", $path);
        $config = require $_SERVER['DOCUMENT_ROOT'] . "/config/config.php";
        $configForGetting = $config;
        for ($i = 0; $i < count($group); $i++) {
            $configForGetting = $configForGetting[$group[$i]];
        }
        return $configForGetting;
    }
}
