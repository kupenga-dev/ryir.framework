<?
$appItem = \Ryir\Core\Application::getInstance();
$pageItem = $appItem->getPage();
?>
<div 
<?isset($result['div_class']) ? print 'class="' . $result['div_class'] . '"' : '';?>
>
<form 
<?isset($result['form_class']) ? print 'class="' . $result['form_class'] . '"' : '';?>
<?isset($result['id']) ? print 'id="' . $result['id'] . '"' : '';?>
<?isset($result['attr']) ? print $result['attr'] : '';?>
<?isset($result['method']) ? print $result['method'] : '';?>
<?isset($result['action']) ? print $result['action'] : '';?>
<?isset($result['title']) ? print $result['title'] : '';?>
>
<h1 
<?isset($result['h1_class']) ? print 'class="' . $result['h1_class'] . '"' : '';?>
>
<?isset($result['h1_title']) ? print $result['h1_title'] : '';?>
</h1>






