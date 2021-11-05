<?php

namespace App\Controllers;

class AuthController extends BaseController
{

    public function __construct($server = null, $request = null)
    {
        parent::__construct($server, $request);
    }

    public function run($params)
    {
        $authItem = new $params['class'];
        $method = $params['action'];
        $authItem->$method();
    }
}
