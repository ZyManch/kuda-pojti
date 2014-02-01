<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'maps-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченые знаком <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mesto_id'); ?>
		<?php echo $form->textField($model,'mesto_id'); ?>
		<?php echo $form->error($model,'mesto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adress'); ?>
		<?php echo $form->textArea($model,'adress',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'adress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phones'); ?>
		<?php echo $form->textArea($model,'phones',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'phones'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'map_x'); ?>
		<?php echo $form->textField($model,'map_x'); ?>
		<?php echo $form->error($model,'map_x'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'map_y'); ?>
		<?php echo $form->textField($model,'map_y'); ?>
		<?php echo $form->error($model,'map_y'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->