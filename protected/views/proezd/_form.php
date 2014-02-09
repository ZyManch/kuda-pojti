<?php
/**
 * @var $form CActiveForm
 */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'maps-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченые знаком <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mesto_id', array('class' => 'label')); ?>
		<?php echo $model->mesto->title; ?>
		<?php echo $form->error($model,'mesto_id'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'info', array('class' => 'label')); ?>
        <?php echo $form->textArea($model,'info',array('rows'=>6, 'class'=>'redactor_box')); ?>
        <?php echo $form->error($model,'info'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'city', array('class' => 'label')); ?>
        <?php echo $form->textField($model,'city',array('size' => 30)); ?>
        <?php echo $form->error($model,'city'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'structure', array('class' => 'label')); ?>
        <?php echo $form->dropDownList($model,'structure', $model->getStructureVariants()); ?>
        <?php echo $form->error($model,'structure'); ?>
    </div>


	<div class="row">
		<?php echo $form->labelEx($model,'adress', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'adress',array('size' => 14)); ?>
		<?php echo $form->error($model,'adress'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'street', array('class' => 'label')); ?>
        <?php echo $form->textField($model,'street',array('size' => 100)); ?>
        <?php echo $form->error($model,'street'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'building', array('class' => 'label')); ?>
        <?php echo $form->textField($model,'building',array('size' => 4)); ?>
        <?php echo $form->error($model,'building'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'office', array('class' => 'label')); ?>
        <?php echo $form->textField($model,'office',array('size' => 5)); ?>
        <?php echo $form->error($model,'office'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'phones', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'phones',array('size' => 100)); ?>
		<?php echo $form->error($model,'phones'); ?>
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