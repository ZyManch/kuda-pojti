<?php
$selected = $filter->getValue($_GET);
$key = rand(1,time());
?>

<div>
    <input type="checkbox" value="<?php print $key;?>" id="<?php print $filter->key . '_' . $key; ?>"
        <?php if($selected == 'yes'):?>checked="checked"<?php endif;?>
           onclick="applyFilter('<?php print $filter->key;?>', this.checked ? 'yes' : 'no', true, false)"/>
    <label for="<?php print $filter->key . '_' . $key; ?>"><?php print $filter->title;?></label>
</div>