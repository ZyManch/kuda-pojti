<?php
/**
 * @var $model Filters
 * @var $form CActiveForm
 */
?>
<div class="form">


    <?php echo CHtml::link(CHtml::image('/images/template/buttons/find.png'),array('admin'));?>
    <?php if (!$model->getIsNewRecord()):?>
        <?php echo CHtml::link(CHtml::image('/images/template/buttons/delete.png'),array('delete','id' => $model->id));?>
        <?php echo CHtml::link(CHtml::image('/images/template/buttons/view.png'),array('view','id' => $model->id));?>
    <?php endif;?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'filters-form',
	'enableAjaxValidation'=>false,
)); ?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'help'); ?>
		<?php echo $form->textArea($model,'help',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'help'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',$model->getTypeVariants()); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'params'); ?>
		<?php echo $form->textArea($model,'params',array('rows'=>12, 'cols'=>50)); ?>
		<?php echo $form->error($model,'params'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model,'category_id',CHtml::listData(Categories::model()->findAll(),'id','title'),array('empty' => 'Общий')); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'king'); ?>
		<?php echo $form->dropDownList($model,'king',$model->getKingVariants()); ?>
		<?php echo $form->error($model,'king'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->textField($model,'position'); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->