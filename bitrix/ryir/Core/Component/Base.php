<?php

namespace Ryir\Core\Component;

abstract class Base
{

    public $result;
    public $id;
    public $params;
    public $template;
    public $__path;

    abstract function executeComponent();
    abstract function __construct();
}
