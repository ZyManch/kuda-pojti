<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'mesto_id',
		'adress',
		'phones',
		'map_x',
		'map_y',
	),
)); ?>
