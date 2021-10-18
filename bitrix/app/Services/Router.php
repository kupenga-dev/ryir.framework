<?php

namespace App\Services;

use App\Controllers\Auth;

class Router
{
    private $authItem;
    private static $rule;
    // private static $List = [];
    public function __construct()
    {
        self::$rule = ["+", "?", "[", "]", "*", "^", "$", "(", ")", "{", "}", "=", "!", "<", ">", "|", ":", "-", "#", "@"];
        $this->authItem = new Auth;
    }
    // Список всех url сайта
    public function __destruct()
    {
        $this->authItm = NULL;
    }

    public function enable()
    {
        $list[] = \App\Controllers\Config::get("routes");
        $query = str_replace(self::$rule, "", $_SERVER['REQUEST_URI']);
        foreach ($list as $router) {
            foreach ($router as $route) {
                if (preg_match($route['pattern'], $query, $matches)) {
                    if ($route['method'] == 'POST') {
                        $method = $route['action'];
                        if ($route['form_data'] == 1) {
                            $data = json_decode(file_get_contents("php://input"), true);
                            var_dump($data);
                            $this->authItem->$method($data);
                            die();
                        } else {
                            $this->authItem->$method();
                            die();
                        }
                    } else {
                        self::viewPage($route['page_name']);
                    }
                }
            }

            // if (preg_match_all("~^ajax/auth/register$~", 'ajax/auth/register', $matches))
            // {
            //     echo 12412412;
            // }

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
