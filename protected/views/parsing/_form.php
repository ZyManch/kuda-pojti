<?php
/**
 * @var $form CActiveForm
 * @var $model ParsingData
 */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parsing-data-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченые знаком <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'status', array('class' => 'label')); ?>
		<?php echo $form->dropDownList($model,'status',array('applied' => 'applied','obtained' => 'obtained')); ?>
		<?php echo $form->error($model,'status',array('class' => 'errorMessage field')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'x', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'x',array('size'=>19,'maxlength'=>19)); ?>
		<?php echo $form->error($model,'x',array('class' => 'errorMessage field')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'y', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'y',array('size'=>19,'maxlength'=>19)); ?>
		<?php echo $form->error($model,'y',array('class' => 'errorMessage field')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address', array('class' => 'label')); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50, 'class'=>'redactor_box')); ?>
		<?php echo $form->error($model,'address',array('class' => 'errorMessage field')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'categories', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'categories',array('rows'=>6, 'cols'=>50, 'class'=>'redactor_box')); ?>
		<?php echo $form->error($model,'categories',array('class' => 'errorMessage field')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'work', array('class' => 'label')); ?>
		<?php echo $form->textArea($model,'work',array('rows'=>6, 'cols'=>50, 'class'=>'redactor_box')); ?>
		<?php echo $form->error($model,'work',array('class' => 'errorMessage field')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phones', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'phones',array('rows'=>6, 'cols'=>50, 'class'=>'redactor_box')); ?>
		<?php echo $form->error($model,'phones',array('class' => 'errorMessage field')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128, 'class'=>'redactor_box')); ?>
		<?php echo $form->error($model,'name',array('class' => 'errorMessage field')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'filters', array('class' => 'label')); ?>
		<?php echo $form->textArea($model,'filters',array('rows'=>6, 'cols'=>50, 'class'=>'redactor_box')); ?>
		<?php echo $form->error($model,'filters',array('class' => 'errorMessage field')); ?>
	</div>

	<div class="row buttons field">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->