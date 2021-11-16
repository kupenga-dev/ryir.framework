<div 
<?isset($result['div_class']) ? print 'class="' . $result['div_class'] . '"' : '';?>
>
<input
type="<?=$result['type'];?>"
<?isset($result['input_class']) ? print 'class="' . $result['button_class'] . '"' : '';?>
>
<?isset($result['name']) ? print 'name="' . $result['name'] . '"' : '';?>
<?isset($result['default']) ? print $result['default'] : '';?>
</input>
</div>