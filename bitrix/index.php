<?php
session_start();




require_once __DIR__ . "/vendor/autoload.php";
$h = new \Ryir\Core\Request;

$routerItem = new \Ryir\Core\Router;
$routerItem->enable();
