<?php

namespace Ryir\Core;

class Page
{
    private $src = [];
    private $link = [];
    private $strings = [];
    private $replace = [];
    private $property = [];
    use \Ryir\Core\Traits\SingletonTrait;

    public function __construct()
    {
        //
    }
    public function addJs($path) //добавляет src в массив сохраняя уникальность.
    {
        if (!isset($this->src[$path])) {
            $this->src[$path] = $path;
        }
    }
    public function addCss($path) //добавляет link сохраняя уникальность
    {
        if (!isset($this->link[$path])) {
            $this->link[$path] = $path;
        }
    }
    public function addString($string) // добавляет в массив для хранения
    {
        $this->strings[] = $string;
    }
    public function setProperty($id, $value) // добавляет для хранение значение по ключу
    {
        $this->property["$id"] = $value;
    }

    public function getProperty($id) // получение по ключу
    {
        return (empty($this->property[$id]) ? "" : $this->property[$id]);
    }
    public function showProperty($id) // выводит макрос для будущей замены #RYIR_PAGE_PROPERY_{$id}# 
    {
        echo $this->getPropertyMacro($id);
    }
    public function getAllReplace() // получает массив макросов и значений для замены
    {
        foreach ($this->property as $key => $value) {
            $replace[$this->getPropertyMacro($key)] = $this->getProperty($key);
        }
        $replace[$this->getMacro('JS')] = $this->setContentJS($this->src);
        $replace[$this->getMacro('CSS')] = $this->setContentCSS($this->link);
        $replace[$this->getMacro('String')] = $this->setContentString($this->strings);
        return $replace;
    }
    private function setContentJS($src)
    {
        $contentJS = '';
        foreach ($src as $value) {
            $contentJS .= '<script src="' . $value . '"></script>' . "\n";
        }
        return $contentJS;
    }
    private function setContentCSS($link)
    {
        $contentCSS = '';
        foreach ($link as $value) {
            $contentCSS .= '<link rel="stylesheet" type="text/css" href="' . $value . '">' . "\n";
        }
        return $contentCSS;
    }
    private function setContentString($strings)
    {
        $contentString = '';
        foreach ($strings as $value) {
            $contentString .= $value . "\n";
        }
        return $contentString;
    }

    public function showHead() // выводит 3 макроса замены CSS / STR / JS
    {
        echo $this->getMacro('JS');
        echo $this->getMacro('CSS');
        echo $this->getMacro('String');
    }
    private function getMacro($id)
    {
        return "#RYIR_PAGE_{$id}#";
    }
    private function getPropertyMacro($id)
    {
        return $this->getMacro($id . "_PROPETRY");
    }
}
