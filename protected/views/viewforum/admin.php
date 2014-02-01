
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'topics-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'content',
		'content_html',
		'user_id',
		'changed',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
