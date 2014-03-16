
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'parsing-data-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'parsing_data_id',
		'search_text',
		'x',
		'y',
		'address',
		'categories',
		/*
		'work',
		'phones',
		'name',
		'url',
		'filters',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
