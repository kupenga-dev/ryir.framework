<?php

namespace Ryir\Core\Traits;


trait SingletonTrait
{

    private static $Instance = null;

    public static function getInstance()
    {
        return static::$Instance ?? (static::$Instance = new static());
    }

    private function __wakeup()
    {
        //
    }

    private function __clone()
    {
        //
    }
}
