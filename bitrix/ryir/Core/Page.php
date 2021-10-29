<?php

namespace Ryir\Core;

class Page
{
    private $src = [];
    private $link = [];
    private $strings = [];
    private $path;
    private $docroot;
    private $replace = [];
    private $templateItem;
    private $property = [];
    private $macro = [];

    use \Ryir\Core\Traits\SingletonTrait;

    public function __construct()
    {
        // $this->docroot = $path;
        $this->templateItem = \Ryir\Core\SitesTempalte::getInstance();
        $this->path = "/templates/" . $this->templateItem->id . "/assets";
        unset($this->templateItem);
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
    public function setPath($path)
    {
        $this->docroot = $path;
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
        $contentJS = '';
        $contentCSS = '';
        $contentString = '';
        foreach ($this->src as $value) {
            if (file_exists($this->docroot . "/" . $value)) {
                $contentJS .= '<script src="' . $value . '"></script>';
            } else {
                $contentJS .= '<script src="' . $this->path . $value . '"></script>';
            }
        }

        foreach ($this->link as $value) {
            if (file_exists($this->docroot . "/" . $value)) {
                $contentCSS .= '<link rel="stylesheet" type="text/css" href="' . $value . '">';
            } else {
                $contentCSS .= '<link rel="stylesheet" type="text/css" href="' . $this->path . $value . '">';
            }
        }
        foreach ($this->strings as $value) {
            $contentString .= $value;
        }
        foreach ($this->property as $key => $value) {
            $this->replace[$this->getPropertyMacro($key)] = $this->getProperty($key);
        }
        $this->replace[$this->getMacro('JS')] = $contentJS;
        $this->replace[$this->getMacro('CSS')] = $contentCSS;
        $this->replace[$this->getMacro('String')] = $contentString;
        return $this->replace;
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
