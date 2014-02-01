
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'forums-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'parent_id',
		'title',
		'content',
		'user_id',
		'forum_count',
		/*
		'topic_count',
		'changed',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
