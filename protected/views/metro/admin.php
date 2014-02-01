
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'metro-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'line',
		'title',
		'map_x',
		'map_y',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
