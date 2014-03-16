<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'parsing_data_id',
		'search_text',
		'x',
		'y',
		'address',
		'categories',
		'work',
		'phones',
		'name',
		'url',
		'filters',
	),
)); ?>
