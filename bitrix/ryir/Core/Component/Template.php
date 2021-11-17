<?php

namespace Ryir\Core\Component;

use Ryir\Core\Application;


class Template
{
    private $id;

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

        if (file_exists($this->component->__path . "/" . "result_modifier.php")) {
            include $this->component->__path . "/" . "result_modifier.php";
        }
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

        if (isset($result['js'])) {
            if (file_exists($this->component->__path . "/" . $result['js'])) {
                $pager->addJs($this->component->__relativePath . "/" . $result['js']);
            }
        }
        if (file_exists($this->component->__path . "/style.css")) {
            $pager->addCSS($this->component->__relativePath . "/style.css");
        }
    }
}
