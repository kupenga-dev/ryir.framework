<?
$appItem = \Ryir\Core\Application::getInstance();
$pageItem = $appItem->getPage();
?>

<body>
<div class="rounded-horizontal-blocks">
  <div class="item">Главная</div>
  <div class="vertical-splitter">|</div>
  <div class="item">Регистрация</div>
  <div class="item">Авторизация</div>
  <div class="item">Профиль</div>
</div>
</body>

<? $pageItem->addCss('/style.css'); ?>
<? $pageItem->addJs('/script.js'); ?>