<?
$appItem = \Ryir\Core\Application::getInstance();
$pageItem = $appItem->getPage();
?>
<label>
<?=$result['title']?>
<input type="
<?=$result['type'];?>"
<?isset($result['name']) ? print 'name="' . $result['name'] . '"' : '';?>
<?isset($result['additional_class']) ? print 'class="' . $result['additional_class'] . '"' : '';?>
<?isset($result['attr']) ? print $result['additional_class'] : '';?>
></label>
