<?php
Yii::import('ext.EGMap.*');
 
$gMap = new EGMap();
foreach ($maps as $map) {
    if (!$map->map_x || !$map->map_y) {
        $geocoded_address = new EGMapGeocodedAddress(
        	Yii::app()->params['city'] . ', ' . $map->adress
        );
        $geocoded_address->geocode($gMap->getGMapClient());
        $map->map_x = $geocoded_address->getLat();
        $map->map_y = $geocoded_address->getLng();
        $map->save();
    }
}
$script = Yii::app()->clientScript; 
$script->registerScriptFile('http://www.google.com/jsapi', CClientScript::POS_HEAD);
$script->registerScript(
    'google_map_init', 
    '
    google.load("maps","3",{"other_params":"sensor=false"});
    var markers = [];
    var map;',
    CClientScript::POS_HEAD
);
$map = $maps[0];
$jsCode = '
var mapOptions = {
    center:    new google.maps.LatLng(' . (float)$map->map_x . ',' . (float)$map->map_y .'),
    zoom:      15,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControlOptions:{
        position: google.maps.ControlPosition.LEFT_BOTTOM,
        style:    google.maps.MapTypeControlStyle.DROPDOWN_MENU
    }
};
map = new google.maps.Map(document.getElementById("map_content"), mapOptions);
';
foreach ($maps as $map) {
    $content = array('<b>Адрес:</b> '. $map->adress);
    if ($map->phones) {
    	$content[] = '<b>Телефон:</b> ' . $map->phones;
    }
    $jsCode.='
    var marker = new google.maps.Marker({
        map:      map,
        position: new google.maps.LatLng(' . (float)$map->map_x . ',' . (float)$map->map_y .')
    });
    var win = new google.maps.InfoWindow();
    win.setContent("' . str_replace("\n", ' ', addslashes(implode('<br/>', $content))) . '");
    win.open(map,marker);
    markers.push(marker);
    ';
}
$jsCode.='';
$script->registerScript(
    'google_map_show',
    $jsCode, 
    CClientScript::POS_READY
);

?>
<p>
    Выберите в списке ниже адрес положения места, чтобы посмотреть его на карте.  
</p> 

<div id="map">
    <div id="map_items">
        <?php foreach ($maps as $pos=>$map): ?>
        <div class="map_item" onclick="map.setCenter(markers[<?php print $pos; ?>].getPosition())">
            <b>Адрес:</b> <?php print $map->structure.' '.$map->adress?><br/>
            <b>Телефон:</b> <?php print $map->phones?><br/>
            <?php if (Yii::app()->params['has_metro']):?>
            <b>Метро:</b> 
            <?php foreach ($map->metro as $metro):?>
                <?php print $metro->title?>
            <?php endforeach;?>
            <?php endif;?>
        </div>
        <?php endforeach;?>
    </div>
    <div id="map_content">
    </div>
</div>
<br/>
