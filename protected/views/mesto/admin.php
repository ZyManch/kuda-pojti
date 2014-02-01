<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mesto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'art',
		'title',
		'content',
		'url',
		'avatar',
		/*
		'email',
		'pages',
		'enabled',
		'description',
		'changed',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
