<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'mesto_id',
		'menu_category_id',
		'price',
		'value',
		'description',
		'changed',
	),
)); ?>
