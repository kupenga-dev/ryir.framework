<?php

namespace App\Services;

class Config
{
    private static $data = [];
    public static function get($path = null)
    {
        if (!static::$data) {
            static::$data = require_once $_SERVER['DOCUMENT_ROOT'] . "/config/config.php";
        }

        $configForGetting = static::$data;
        if (!isset($path)) {
            return $configForGetting;
        }
        $group = explode("/", $path);
        for ($i = 0; $i < count($group); $i++) {
            $configForGetting = $configForGetting[$group[$i]];
        }
        return $configForGetting;
    }
}
