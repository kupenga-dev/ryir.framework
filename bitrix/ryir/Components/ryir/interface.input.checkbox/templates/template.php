<div 
<?isset($result['div_class']) ? print 'class="' . $result['div_class'] . '"' : '';?>
>
<button
type="<?=$result['type'];?>"
<?isset($result['button_class']) ? print 'class="' . $result['button_class'] . '"' : '';?>
>
<?isset($result['default']) ? print $result['default'] : '';?>
</button>
</div>