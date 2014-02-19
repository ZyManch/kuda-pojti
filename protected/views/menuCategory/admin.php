
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'menu-category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'url',
		'title',
		'settings',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
