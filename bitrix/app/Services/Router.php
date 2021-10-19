<?php

namespace App\Services;

class Router
{
    private $authItem;
    private static $rule;
    private static $list;
    // private static $List = [];
    public function __construct()
    {
        self::$list[] = \App\Controllers\Config::get("routes");
        self::$rule = ["+", "?", "[", "]", "*", "^", "$", "(", ")", "{", "}", "=", "!", "<", ">", "|", ":", "-", "#", "@"];
        $this->authItem = new \App\Controllers\Auth;
    }

    public function enable()
    {
        $query = str_replace(self::$rule, "", $_SERVER['REQUEST_URI']);

        foreach (self::$list as $router) {
            foreach ($router as $route) {
                if (preg_match_all($route['pattern'], $query, $matches)) {
                    if ($route['method'] == 'POST') {
                        $method = $route['action'];
                        $this->authItem->$method();
                    } else {
                        self::viewPage($route['page_name']);
                    }
                }
            }
        }
        self::page_not_found();
    }




    private static function page_not_found()
    {
        require_once 'views/errors/eror.php';
        die();
    }

    private static function viewPage($path)
    {
        require_once 'views/pages/' . $path . '.php';
        die();
    }

    public static function redirect($uri)
    {
        return header('Location: ' . $uri);
    }
}
