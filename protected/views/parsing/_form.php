<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parsing-data-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченые знаком <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'search_text'); ?>
		<?php echo $form->textField($model,'search_text',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'search_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'x'); ?>
		<?php echo $form->textField($model,'x',array('size'=>19,'maxlength'=>19)); ?>
		<?php echo $form->error($model,'x'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'y'); ?>
		<?php echo $form->textField($model,'y',array('size'=>19,'maxlength'=>19)); ?>
		<?php echo $form->error($model,'y'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'categories'); ?>
		<?php echo $form->textArea($model,'categories',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'categories'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'work'); ?>
		<?php echo $form->textArea($model,'work',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'work'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phones'); ?>
		<?php echo $form->textArea($model,'phones',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'phones'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url'); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'filters'); ?>
		<?php echo $form->textArea($model,'filters',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'filters'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->