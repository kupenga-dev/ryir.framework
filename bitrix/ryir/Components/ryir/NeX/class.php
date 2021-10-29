<?php

namespace Atice\ryir;

use Ryir\Core\Component\Base;

//класс компонента NeX

class NeX extends Base
{
    public $result;
    public $id;
    public $params = [];
    public $template;
    public $__path;
    
    public function __construct(string $id, string $template, array $params)
    {
        parent::__construct($id, $template, $params);
    }

    public function executeComponent()
    {
        $this->params['location'] = $this->__path;
        $this->componentTemplate->render(''); 
    }
}
