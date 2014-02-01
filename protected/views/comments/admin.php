
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comments-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'mesto_id',
		'user_id',
		'content',
		'reply',
		'created',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
