<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'mesto_id',
		'title',
		'preview',
		'url',
		'width',
		'height',
	),
)); ?>
