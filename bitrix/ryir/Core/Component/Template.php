<?php

namespace Ryir\Core\Component;

use Ryir\Core\Application;


class Template
{
    private $id;
    // private $template;
    // private $params = [];
    private $component;

    public function __construct(string $id, $component)
    {
        $this->component = $component;
        $this->id = $id;
    }

    public function render(string $page = 'template') // должен подключать файл шаблона, + стили и js | $page - страница подключения в шаблоне. По дефолту template.php
    {
        $params = $this->component->getParams();
        $result = $this->component->getResult();
        $pager = Application::getInstance()->getPage();
        //подключаются файл result_mod.. 
        if (file_exists($this->component->__path . "/" . "result_modifier.php")) {
            include $this->component->__path . "/" . "result_modifier.php";
        }
        //объявить две переменные для работы result и params - доступны внутри template.php
        if (file_exists($this->component->__path . "/" . $page . ".php")) {
            include $this->component->__path . "/" . $page . ".php";
        } else {
            if (file_exists($this->component->__path . "/" . "template.php")) {
                include $this->component->__path . "/" . ".php";
            }
        }
        if (file_exists($this->component->__path . "/" . "component_epilog.php")) {
            include $this->component->__path . "/" . "component_epilog.php";
        }
        //наличие всех файлов
        if (file_exists($this->component->__path . "/script.js")) {
            $pager->addJs($this->component->__relativePath . "/script.js");
        }
        if (file_exists($this->component->__path . "/style.css")) {
            $pager->addCSS($this->component->__relativePath . "/style.css");
        }
    }
}
