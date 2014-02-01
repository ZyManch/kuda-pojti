
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'work-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'maps_id',
		'day_begin',
		'day_end',
		'time_begin',
		'time_end',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
