
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'maps-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'mesto_id',
		'adress',
		'phones',
		'map_x',
		'map_y',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
