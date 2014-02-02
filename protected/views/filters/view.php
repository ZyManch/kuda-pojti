
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'help',
		'type',
		'params',
		'category_id',
		'king',
		'position',
	),
)); ?>
