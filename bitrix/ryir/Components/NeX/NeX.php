<?php

namespace Ryir\Components;

use Ryir\Core\Component\Base;

//класс компонента  NeX

class NeX extends Base
{
    // public $result;
    // public $id;
    public $params;
    public $template;
    // public $__path;

    public function __construct(string $template, array $params)
    {
        $this->template = $template;
        $this->params = $params;
    }

    public function executeComponent()
    {
        //
    }
    
}
