<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'metro-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченые знаком <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'line', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'line',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'line'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'title',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'map_x', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'map_x'); ?>
		<?php echo $form->error($model,'map_x'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'map_y', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'map_y'); ?>
		<?php echo $form->error($model,'map_y'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->