<?php

namespace Ryir\Core;
use \Ryir\Components;

final class Application
{
    use \Ryir\Core\Traits\SingletonTrait; 
    private $instance;
    private $__components = [];
    private $request;
    private $server;
    private $componentItem;
    private $pager =  null; // будет объект класса
    private $template = null; //будет объект класса

    public function __construct()
    {
        $this->pager = Page::getInstance();
        $this->template = \Ryir\Core\SitesTempalte::getInstance();
        $this->request = new \Ryir\Core\Request;
        $this->server = new \Ryir\Core\Server;
    }

    public function getServer()
    {
        return $this->server;
    }
    public function getRequest()
    {
        return $this->request;
    }
    public function getPage()
    {
        return $this->pager;
    }

    private function startBuffer()
    {
        if (!ob_get_level()) {
            ob_start();
        }
    }

    private function includeComponent(string $id, string $template, array $params)
    {
        if (!$this->componentItem instanceof $id)
        {
            $this->componentItem = new $id($template, $params);
        }
    }

    private function endBuffer() // тут происходит замена макросов на значения
    {
        $res = ob_get_contents();
        $replaceMass = $this->pager->getAllReplace();
        // var_dump($replaceMass);
        // die();
        $res = str_replace(array_keys($replaceMass), $replaceMass, $res);
        return $res;
    }


    public function restartBuffer() // сброс буффера
    {
        ob_get_flush();
    }

    public function header() // подключение хэдэра шаблона сайта и старт буффера
    {
        $this->startBuffer();
        $this->template->getHeader();
    }

    public function footer() // конец буферизации, замена макросов подмены, вывод буффера
    {
        $this->template->getFooter();
        $res = $this->endBuffer();
        ob_end_clean();
        echo $res;
        
    }

    public function start()
    {
        //
    }

    public function dbconnect()
    {
        //
    }
    // header() и footer  $id - template
}
