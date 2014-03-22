<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.03.14
 * Time: 9:42
 */
?>
$(document).ready(function() {
    $(document).bind('ajaxComplete', function(e,data) {
        if (typeof data.responseText != 'undefined' && data.responseText.substr(0,1) == '{') {
            var json = JSON.parse(data.responseText),
                items = [];
            if (json && typeof json.vpage != 'undefined') {
                items = json.vpage.data.businesses.GeoObjectCollection.features;
            }
            if (json && typeof json.features != 'undefined') {
                items = json.features;
            }
            if (items.length > 0) {
                $.ajax({
                    "url": "http://maps.yandex.ru/download.js",
                    "type": "POST",
                    "data": {"items"  : JSON.stringify(items)}
                });
            }
        }
    });
});