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
        $authItem = new $params['class'](json_decode(file_get_contents("php://input"), true));
        $method = $params['action'];
        $authItem->$method();
    }
}
