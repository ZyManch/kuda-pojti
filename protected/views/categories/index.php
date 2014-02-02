<?php if (Yii::app()->user->checkAccess(WebUser::TYPE_MODERATOR)):?>
<?php echo CHtml::link(CHtml::image('/images/template/buttons/find.png'),array('admin'));?>
<?php endif;?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
