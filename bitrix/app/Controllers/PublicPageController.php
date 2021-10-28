<?php

namespace App\Controllers;


class PublicPageController extends BaseController
{
    private $path;
    public function __construct()
    {
        $this->path = $_SERVER['DOCUMENT_ROOT'] . "/public/pages/";
    }
    public function run($params)
    {
        include_once $this->path . $params['path'];
        die();
    }
}
