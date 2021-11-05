<?php
session_start();




require_once __DIR__ . "/vendor/autoload.php";

$routerItem = new \Ryir\Core\Router;
$routerItem->enable();
