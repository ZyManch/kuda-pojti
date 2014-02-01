<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'line',
		'title',
		'map_x',
		'map_y',
	),
)); ?>
