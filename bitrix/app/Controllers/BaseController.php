<?php

namespace App\Controllers;


abstract class BaseController {
    
    abstract function run($params);
    protected $path;
    protected $requestItem;
    protected $serverItem;

    public function __construct($server = null, $request = null)
    {
        if (isset($server))
        {
            $this->serverItem = $server;
            $this->path = $this->serverItem->getDocumentRoot() . "/public/pages/";
        }
        if (isset($request))
        {
            $this->requestItem = $request; 
        }
    }

    public function page_not_found()
    {
        include_once 'public/views/pages/404.php';
        die();
    }

}

?>