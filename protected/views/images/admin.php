
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'images-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'mesto_id',
		'title',
		'preview',
		'url',
		'width',
		/*
		'height',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
