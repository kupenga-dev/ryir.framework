<?php

namespace Ryir\Core\Component;
//

class Template
{
    private $id;
    private $template;
    // private $params = [];
    private $__path; //путь к шаблону на сервере $this->appItem->getServer();
    private $__relativePath; //url к папке с шаблоном
    private $page;

    public function __construct(string $id, string $template)
    {
        $this->page = \Ryir\Core\Application::getInstance()->getPage();
        $this->docroot = \Ryir\Core\Application::getInstance()->getServer()->getDocumentRoot();
        // $this->params = $params;
        $this->id = $id;
        $this->template = $template;
        $this->__relativePath = "/ryir/Components/" . $this->id . "/templates/" . $this->template;
        $this->__path = $this->docroot . $this->__relativePath;
        
    }

    public function render(string $page) // должен подключать файл шаблона, + стили и js | $page - страница подключения в шаблоне. По дефолту template.php
    {
        if (file_exists($this->__path . "/" . $page . ".php")) {
            include $this->__path . "/" . $page;
        } else {
            include $this->__path . "/" . "template.php";
        }
        $this->page->addJs($this->__relativePath . "/script.js");
        $this->page->addCSS($this->__relativePath . "/style.css");
    }
}
