
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'menu-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'mesto_id',
		'menu_category_id',
		'price',
		'value',
		/*
		'description',
		'changed',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
