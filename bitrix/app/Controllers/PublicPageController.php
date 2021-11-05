<?php

namespace App\Controllers;


class PublicPageController extends BaseController
{
    public function __construct($server = null, $request = null)
    {
        parent::__construct($server, $request);
    }
    public function run($params)
    {
        include_once $this->path . $params['path'];
        die();
    }
}
