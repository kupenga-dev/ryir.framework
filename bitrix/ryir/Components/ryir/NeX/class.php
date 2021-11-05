<?php

use Ryir\Core\Component\Base;

use Ryir\Core\Traits\ComponentTrait;

//класс компонента NeX

class NeX extends Base
{
    protected $result; 
    protected $params = []; 
    use ComponentTrait;
    
    public function getResult()
    {
        return $this->result;
    }
    public function getParams()
    {
        return $this->params;
    }

    public function executeComponent()
    {
        $this->componentTemplate->render(); 
    }
}
