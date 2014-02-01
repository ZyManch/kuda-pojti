
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'email',
		'pass',
		'type',
		'changed',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
