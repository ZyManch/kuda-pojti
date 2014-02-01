<?php 
$items = $filter->extractParams($_GET);
$value = $filter->getValue($_GET);
?>
<?php foreach ($items as $key => $item):?>
    <div>
        <input type="radio" value="<?php print $key;?>" name="radio_<?php print $filter->key;?>" 
            <?php if($key == $value):?>checked="checked"<?php endif;?> id="<?php print $filter->key . '_' . $key; ?>"
            onclick="applyFilter('<?php print $filter->key;?>', '<?php print $key;?>', this.checked, false)"/>
        <label for="<?php print $filter->key . '_' . $key; ?>"><?php print $item;?></label>
    </div>
<?php endforeach;?>