<?php

namespace Ryir\Core\Component;
//

class Template
{
    use \Ryir\Core\Traits\SingletonTrait;
    private $id;
    private $template;
    private $__path; //путь к шаблону на сервере
    private $__relativePath; //url к папке с шаблоном

    private function __construct()
    {
        $this->appItem = \Ryir\Core\Application::getInstance();
        $this->page = $this->appItem->getPage();
        unset($appTem);
        $this->id = \App\Services\Config::get('component/id');
        $this->template = \App\Services\Config::get('component/template_id');
        $this->__path = $_SERVER['DOCUMENT_ROOT'] . "/ryir/Components/" . $this->id . "/templates/" . $this->template;
        $this->__relativePath = "/ryir/Components/" . $this->id . "/templates/" . $this->template;
    }

    public function render(string $page) // должен подключать файл шаблона, + стили и js | $page - страница подключения в шаблоне. По дефолту template.php
    {
        if (file_exists($this->__path . "/" . $page)) {
            include $this->__path . "/" . $page;
        } else {
            include $this->__path . "/" . "template.php";
        }
        $this->page->addCss($this->__relativePath . "/script.js");
        $this->page->addJs($this->__relativePath . "/style.css");
    }
}
