<?php
session_start();




require_once __DIR__ . "/vendor/autoload.php";
\App\Services\Application::start();
// \App\Controllers\Config::get("db/name");
$routerItem = new App\Services\Router;
$routerItem->enable();
require_once __DIR__ . "/router/addUri.php";




?>