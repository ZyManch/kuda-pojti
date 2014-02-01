<?php 
$items = $filter->extractParams($_GET);
$value = $filter->getValue($_GET);
?>
<div class="search_filter">
<input type="text" value="<?php print CHtml::encode($value);?>"
    onkeyup="findValues(this, '<?php print CHtml::normalizeUrl(array('metro/search'));?>')"
    onchange="applyFilter('<?php print $filter->key;?>', this.value, true, false); "/>
<div class="options"></div>
</div>
