<?php 
$items = $filter->extractParams($_GET);
$selected = $filter->getValue($_GET);
?>

<?php foreach ($items as $key => $item):?>
    <div>
        <input type="checkbox" value="<?php print $key;?>" id="<?php print $filter->key . '_' . $key; ?>"
            <?php if(in_array($key, $selected)):?>checked="checked"<?php endif;?>
            onclick="applyFilter('<?php print $filter->key;?>', '<?php print $key;?>', this.checked, true)"/>
        <label for="<?php print $filter->key . '_' . $key; ?>"><?php print $item;?></label>
    </div>
<?php endforeach;?>