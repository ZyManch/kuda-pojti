
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'filters-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'help',
		'type',
		'params',
		'category_id',
		/*
		'king',
		'position',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
