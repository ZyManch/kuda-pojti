<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categories-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'content',
		'description',
		'url',
		'avatar',
		/*
		'position',
		'changed',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
