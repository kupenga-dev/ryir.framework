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

    private function colletctComponents($params)
    {
        $appItem = Application::getInstance();
        $map = [
            'text' => 'input.text',
            'text.multiple' => 'input.text.multiple',
            'number' => 'input.number',
            'password' => 'input.password',
            'e-mail' => 'input.email',
            'checkbox' => 'input.checkbox',
            'checkbox.multiple' => 'input.checkbox.multiple',
            'radio' => 'input.radio',
            'radio.multiple' => 'input.radio.multiple',
            'select' => 'input.select',
            'select.multiple' => 'input.select.multiple',
            'textarea' => 'textarea',
            'submit' => 'button',
        ];
        foreach ($map as $key => $value) {
            for ($i = 0; $i < count($params); $i++) {
                ($key == $params[$i]['type']) ? $appItem->includeComponent("ryir:interface.$value", 'stis', $params[$i]) : '';
            }
        }
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
        if (isset($params['elements'])) {
            $this->colletctComponents($params['elements']);
        }
        if (file_exists($this->component->__path . "/" . "component_epilog.php")) {
            include $this->component->__path . "/" . "component_epilog.php";
        }
        
        //наличие всех файлов
        if (file_exists($this->component->__path . "/auth.js")) {
            $pager->addJs($this->component->__relativePath . "/auth.js");
        } elseif (file_exists($this->component->__path . "/register.js")) {
            $pager->addJs($this->component->__relativePath . "/register.js");
            var_dump($this->component->__relativePath);
        }
        if (file_exists($this->component->__path . "/style.css")) {
            $pager->addCSS($this->component->__relativePath . "/style.css");
        }
    }
}
