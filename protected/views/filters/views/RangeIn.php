<?php
$script = Yii::app()->clientScript;
$script->registerCoreScript('jquery.ui');
$script->registerScript(
    'range_script',
    '$(".track .value").draggable({
        axis: "x",
        containment: "parent",
        drag: function(event, ui) {
            var element = event.target;
            var $element = $(element);
            var left = element.offsetLeft;
            var min = $element.attr("min");
            var log = $element.attr("log");
            var key = $element.attr("key");
            var text = $element.attr("text"); 
            var value = Math.round(min - 1 + Math.pow(log, left));
            $("#text"+key).text(text.replace("%d", value));
            applyFilter(key, value, true, false);
        }
    })',
    CClientScript::POS_READY
);
$value = $filter->getValue($_GET);
$params = $filter->extractParams($_GET);
$left = round(log($value-$params['min'] + 1, $params['log']));
?>
<div id="text<?php print $filter->key;?>"><?php printf($params['text'], $value);?></div>
<div class="track">
    <div class="value" key="<?php print $filter->key;?>" min="<?php print $params['min'];?>"
        text="<?php print $params['text'];?>" log="<?php print $params['log']?>" 
        style="left:<?php print $left;?>px"></div>
</div>

