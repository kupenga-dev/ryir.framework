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
    public function __construct(string $id, string $template, array $params)
    {
        $this->id = $id;
        $this->template = $template;
        $this->params = $params;
    }
    
}
