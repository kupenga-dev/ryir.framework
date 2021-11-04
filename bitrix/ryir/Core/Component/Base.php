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
    protected $__relativePath;
    protected $__path;

    abstract function executeComponent();
    protected function __construct(string $id, string $template, array $params)
    {
        $this->id = str_replace(":", "/", $id);
        $this->template = $template;
        $this->params = $params;
        $this->docroot = Application::getInstance()->getServer()->getDocumentRoot();
        $this->__relativePath = "/ryir/Components/" . $this->id . "/templates/" . $this->template;
        $this->__path = $this->docroot . $this->__relativePath;
    }
}
