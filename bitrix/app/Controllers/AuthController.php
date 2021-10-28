<?php
namespace App\Controllers;

class AuthController extends BaseController {

    public function run($params)
    {
        $authItem = new $params['class'];
        $method = $params['action'];
        $authItem->$method();
    }
}