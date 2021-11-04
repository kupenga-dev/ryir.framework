<?php

namespace Ryir\Core\Component;

use Ryir\Core\Application;


class Template
{
    private $id;
    // private $template;
    // private $params = [];
    private $__path;
    private $component;
    private $__relativePath; //url к папке с шаблоном
    private $page;

    public function __construct(string $id, $component, $path, $relativePath)
    {
        $this->component = $component;
        $this->__path = $path;
        $this->__relativePath = $relativePath;
        $this->page = Application::getInstance()->getPage();
        $this->id = $id;
    }

    public function render(string $page = 'template') // должен подключать файл шаблона, + стили и js | $page - страница подключения в шаблоне. По дефолту template.php
    {
        $params = $this->component->GetParams();
        $result = $this->component->GetResult();
        //подключаются файл result_mod.. 
        if (file_exists($this->__path . "/" . "result_modifier.php")) {
            include $this->__path . "/" . "result_modifier.php";
        }
        //объявить две переменные для работы result и params - доступны внутри template.php
        if (file_exists($this->__path . "/" . $page . ".php")) {
            include $this->__path . "/" . $page . ".php";
        } else {
            if (file_exists($this->__path . "/" . "template.php")) {
                include $this->__path . "/" . ".php";
            }
        }
        if (file_exists($this->__path . "/" . "component_epilog.php")) {
            include $this->__path . "/" . "component_epilog.php";
        }
        //наличие всех файлов
        if (file_exists($this->__path . "/script.js")) {
            $this->page->addJs($this->__relativePath . "/script.js");
        }
        if (file_exists($this->__path . "/style.css")) {
            $this->page->addCSS($this->__relativePath . "/style.css");
        }
    }
}
