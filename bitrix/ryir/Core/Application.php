<?php

namespace Ryir\Core;

use Ryir\Core\Component\Base;
use Ryir\Core\SitesTempalte;
use Ryir\Core\Server;
use Ryir\Core\Request;

final class Application
{
    use \Ryir\Core\Traits\SingletonTrait;
    private $instance;
    private $__components = [];
    private $request;
    private $server;
    private $pager =  null; // будет объект класса
    private $template = null; //будет объект класса

    public function __construct()
    {
        $this->pager = Page::getInstance();
        $this->template = SitesTemplate::getInstance();
        $this->request = new Request($_REQUEST);
        $this->server = new Server($_SERVER);
        $this->template->setPath($this->server->getDocumentRoot());
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

    public function includeComponent(string $id, string $template, array $params)
    {
        if (!isset($this->__components[$id])) {
            $allClasses = get_declared_classes();
            $loader = $this->server->getDocumentRoot() . "/ryir/Components/" . str_replace(":", "/", $id)  .  '/class.php';
            if (file_exists($loader)) {
                include_once($loader);
            }
            $fileNamespace = array_diff(get_declared_classes(), $allClasses);
            foreach ($fileNamespace as $value) {
                if (is_subclass_of($value, Base::class)) {
                    $this->__components[$id] = $value;
                    break;
                }
            }
        }
        if (isset($this->__components[$id])) {
            $instance = new $this->__components[$id]($id, $template, $params);
            $instance->executeComponent();
        }
    }

    private function endBuffer() // тут происходит замена макросов на значения
    {
        $res = ob_get_contents();
        $replaceMass = $this->pager->getAllReplace();
        $res = str_replace(array_keys($replaceMass), $replaceMass, $res);
        $this->restartBuffer();
        echo $res;
    }


    public function restartBuffer() // сброс буффера
    {
        ob_end_clean();
        ob_start();
    }

    public function header() // подключение хэдэра шаблона сайта и старт буффера
    {
        $this->startBuffer();
        $this->template->getHeader();
    }

    public function footer() // конец буферизации, замена макросов подмены, вывод буффера
    {
        $this->template->getFooter();
        $this->endBuffer();
        ob_get_flush();
    }

    public function start()
    {
        //
    }

    public function dbconnect()
    {
        //
    }
}
