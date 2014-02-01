
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'forums-cats-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'parent_id',
		'position',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
