<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченые знаком <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows' => 15, 'style' => 'width: 950px')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Добавить комментарий'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<div id="add_comment">
    <?php echo CHtml::button('Добавить комментарий', array(
        'onclick' => '$(this).hide().parent().prev(".form").slideDown();'
    )); ?>
</div>