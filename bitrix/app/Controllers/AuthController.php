<?php
namespace App\Controllers;

class AuthController extends BaseController {

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
        $authItem = new $params['class'];
        $method = $params['action'];
        $authItem->$method();
    }
}