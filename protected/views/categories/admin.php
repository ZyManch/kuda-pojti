<br>
<?php echo CHtml::link(CHtml::image('/images/template/buttons/add.png'), array('create'),array('class' => ''));?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categories-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'content',
		'description',
		'url',
		'avatar',
		array(
			'class'=>'CButtonColumn',
            'viewButtonUrl'=>'Yii::app()->controller->createUrl("view",array("id"=>$data->url))',
            'updateButtonUrl'=>'Yii::app()->controller->createUrl("update",array("id"=>$data->url))',
            'deleteButtonUrl'=>'Yii::app()->controller->createUrl("delete",array("id"=>$data->url))',
		),
	),
)); ?>
