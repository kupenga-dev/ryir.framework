<?php

namespace App\Controllers;


abstract class BaseController {
    
    abstract function run($params);

    public function page_not_found()
    {
        include_once 'public/views/pages/404.php';
        die();
    }

}

?>