<div 
<?isset($result['div_class']) ? print 'class="' . $result['div_class'] . '"' : '';?>
>
<label 
<?isset($result['label_class']) ? print 'class="' . $result['label_class'] . '"' : '';?>
><?isset($result['default']) ? print $result['default']: '';?>
</label>
<input
type="<?=$result['type'];?>"
<?isset($result['input_class']) ? print 'class="' . $result['input_class'] . '"' : '';?>
>
</div>