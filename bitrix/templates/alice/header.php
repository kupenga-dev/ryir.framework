<?
$appItem = \Ryir\Core\Application::getInstance();
$pageItem = $appItem->getPage();

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <? $pageItem->showHead(); ?>
    <title><? $pageItem->showProperty('title'); ?></title>


</head>

<body>
    <? $pageItem->addCss('/css/style.css'); ?>
    <? $pageItem->addJs('/js/auth.js'); ?>
    <? $pageItem->addJs('/js/jquery-3.6.0.min.js'); ?>
    <? $pageItem->addJs('/js/script.js'); ?>
    <? $pageItem->setProperty('title', 'Home'); ?>