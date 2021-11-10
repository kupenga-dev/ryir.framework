<?
$appItem = \Ryir\Core\Application::getInstance();
$pageItem = $appItem->getPage();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <? $pageItem->addCSS('ryir/libs/bootstrap-5.1.3-dist/css/bootstrap-grid.min.css'); ?>
    <? $pageItem->addCSS('ryir/libs/bootstrap-5.1.3-dist/css/bootstrap.css'); ?>
    <? $pageItem->addCss('templates/alice/assets/css/style.css'); ?>
    <? $pageItem->addJs('templates/alice/assets/js/jquery-3.6.0.min.js'); ?>
    <? $pageItem->addJs('ryir/libs/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js'); ?>
    <? $pageItem->setProperty('title', 'Home'); ?>
    <? $pageItem->showHead(); ?>
    <? include_once('templates/alice/components/navbar.php'); ?>
    <title><? $pageItem->showProperty('title'); ?></title>
</head>
<body>
    