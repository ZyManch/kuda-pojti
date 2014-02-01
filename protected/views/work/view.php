<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'maps_id',
		'day_begin',
		'day_end',
		'time_begin',
		'time_end',
	),
)); ?>
