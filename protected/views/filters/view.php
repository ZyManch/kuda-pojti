<?php if (Yii::app()->user->checkAccess('moderator')):?>
<?php echo CHtml::link(CHtml::image('/images/template/buttons/find.png'),array('admin'));?>
<?php echo CHtml::link(CHtml::image('/images/template/buttons/delete.png'),array('delete','id' => $model->id));?>
<?php echo CHtml::link(CHtml::image('/images/template/buttons/update.png'),array('update','id' => $model->id));?>
<?php endif;?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'help',
		'type',
		'params',
		'category_id',
		'king',
		'position',
	),
)); ?>
