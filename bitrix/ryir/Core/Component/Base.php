<?php

namespace Ryir\Core\Component;

abstract class Base
{

    public $result;
    public $id;
    public $params;
    public $template;
    public $__path;
    public $componentTemplate;

    abstract function executeComponent();
    protected function __construct(string $id, string $template, array $params)
    {
        $this->id = $id;
        $this->template = $template;
        $this->params = $params;
        $this->componentTemplate = new \Ryir\Core\Component\Template($this->id, $this->template, $this->params);
        $docroot = \Ryir\Core\Application::getInstance()->getServer()->getDocumentRoot();
        $this->__path = $docroot . "/ryir/Components/" . $this->id . "/templates/" . $this->template;
    }
}
