<?php

namespace Ryir\Core\Component;

use Ryir\Core\Application;

abstract class Base
{
    protected $docroot;
    protected $result;
    public $id;
    protected $params;
    public $template;
    public $__relativePath;
    public $__path;

    abstract function executeComponent();
    protected function __construct(string $id, string $template, array $params)
    {
        $id = str_replace(":", "/", $id);
        $this->params = $params;
        $this->docroot = Application::getInstance()->getServer()->getDocumentRoot();
        $this->__relativePath = "/ryir/Components/" . $id . "/templates/" . $template;
        $this->__path = $this->docroot . $this->__relativePath;
    }
    
}
