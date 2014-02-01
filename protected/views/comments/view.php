<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'mesto_id',
		'user_id',
		'content',
		'reply',
		'created',
	),
)); ?>
