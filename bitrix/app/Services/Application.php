<?php

namespace App\Services;

final class Application
{
    use \App\Patterns\SingletonTrait;

    private $instance;
    private $__components = [];
    private $pager =  null; // будет объект класса
    private $template = null; //будет объект класса


    public static function start()
    {
        
    }
    
    public static function dbconnect()
    {

    }
}
