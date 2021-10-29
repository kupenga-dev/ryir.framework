<?php

namespace Ryir\Components;

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
        $this->id = $id;
        $this->template = $template;
        $this->params = $params;
        $serverItem = \Ryir\Core\Application::getInstance()->getServer()->getDocumentRoot();
        $this->__path = $serverItem . "/ryir/Components/" . $this->id . "/templates/" . $this->template;
    }

    public function executeComponent()
    {
        $this->params['location'] = $this->__path;
        $this->componentTemplate = new \Ryir\Core\Component\Template($this->id, $this->template, $this->params);
        $this->componentTemplate->render(''); 
    }
    
}
