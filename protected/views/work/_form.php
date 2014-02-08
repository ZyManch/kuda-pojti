<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'work-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченые знаком <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'maps_id', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'maps_id'); ?>
		<?php echo $form->error($model,'maps_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'day_begin', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'day_begin'); ?>
		<?php echo $form->error($model,'day_begin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'day_end', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'day_end'); ?>
		<?php echo $form->error($model,'day_end'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_begin', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'time_begin'); ?>
		<?php echo $form->error($model,'time_begin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_end', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'time_end'); ?>
		<?php echo $form->error($model,'time_end'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->