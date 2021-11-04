<?php

use Ryir\Core\Component\Base;
use Ryir\Core\Component\Template;
//класс компонента NeX

class NeX extends Base
{
    protected $result; 
    protected $params = []; 
    
    public function __construct(string $id, string $template, array $params)
    {
        parent::__construct($id, $template, $params);
        $this->componentTemplate = new Template($this->id, $this, $this->__path, $this->__relativePath);
    }
    public function GetResult()
    {
        return $this->result;
    }
    public function GetParams()
    {
        return $this->params;
    }

    public function executeComponent()
    {
        $this->componentTemplate->render(); 
    }
}
