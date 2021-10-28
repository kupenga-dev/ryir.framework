<?php

namespace App\Services;

class Config
{
    private static $data = [];
    public static function get($path)
    {
        if (!static::$data)
        {
            static::$data = require_once $_SERVER['DOCUMENT_ROOT'] . "/config/config.php";
        }
        $group = explode("/", $path);
        $configForGetting = static::$data;
        for ($i = 0; $i < count($group); $i++) {
            $configForGetting = $configForGetting[$group[$i]];
        }
        return $configForGetting;
    }
}
