<?php

namespace App\Controllers;


class PublicPageController extends BaseController
{
    private $path;
    private $requestItem;
    private $serverItem;
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
    public function run($params)
    {
        include_once $this->path . $params['path'];
        die();
    }
}
