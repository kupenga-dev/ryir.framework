<?php

namespace App\Controllers;

class Config
{
    public static function get($path)
    {
        $group = explode("/", $path);
        $config = require __DIR__ . "../../../config/config.php";
        
        isset($group[0]) ? $confingName = $group[0] : $confingName = null;
        isset($group[1]) ? $confingPart = $group[1] : $confingPart = null;

        return isset($confingPart) ? $config[$confingName][$confingPart] : $config[$confingName];



        // if ($group[0] == "db")
        // {

        // }

        // if ($group[0] == "routes")
        // {
        //     return isset($group[1]) ? $config["routes"]["$group[1]"] : $config["routes"];
        // }




        // if (is_null($element)) {
        //     return $config["$path"];
        // } else {
        //     return $config["$path"]["$element"];
        // }
    }
}
