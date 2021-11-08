<?
$appItem = \Ryir\Core\Application::getInstance();
$pageItem = $appItem->getPage();
?>

<form action=<?=$params['additional_class'];?> id="<?=$params['attr']['data-form-id'];?>" method="<?=$params['method'];?>">

</form>

<? $pageItem->addCss('/style.css'); ?>
<? $pageItem->addJs('/script.js'); ?>