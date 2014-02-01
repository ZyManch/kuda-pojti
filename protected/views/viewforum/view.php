<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'content',
		'content_html',
		'user_id',
		'changed',
	),
)); ?>
