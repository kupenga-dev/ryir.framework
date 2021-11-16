<?php

namespace Ryir\Core;

use App\Services\Config;

class Router
{
    private static $rule;
    private static $list;
    private $requestItem;
    private $serverItem;
    public function __construct()
    {
        self::$list[] = Config::get("routes");
        self::$rule = ["+", "?", "[", "]", "*", "^", "$", "(", ")", "{", "}", "=", "!", "<", ">", "|", ":", "-", "#", "@"];
        $appItem = new Application;
        $this->requestItem = $appItem->getRequest();
        $this->serverItem = $appItem->getServer();
        unset($appItem);
    }

    public function enable()
    {
        $query = str_replace(self::$rule, "", $this->serverItem->getRequestUri());
        foreach (self::$list as $router) {
            foreach ($router as $route) {
                if (preg_match_all($route['pattern'], $query, $matches)) {
                    if (get_parent_class($route['params']['controller']) == 'App\Controllers\BaseController') {
                        $controllerItem = new $route['params']['controller']($this->serverItem, $this->requestItem);
                        $controllerItem->run($route['params']);
                    } else {
                        //
                    }
                }
            }
        }
    }


    public static function redirect($uri)
    {
        return header('Location: ' . $uri);
    }
}
