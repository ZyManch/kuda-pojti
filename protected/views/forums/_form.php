<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'forums-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченые знаком <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($forum); ?>
    <?php echo $form->errorSummary($topic); ?>

	<div class="row">
		<?php echo $form->labelEx($forum,'title'); ?>
		<?php echo $form->textField($forum,'title',array('size'=>100,'maxlength'=>128)); ?>
		<?php echo $form->error($forum,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($topic,'content'); ?>
		<?php echo $form->textArea($topic, 'content', array('rows'=>15, 'cols'=>133)); ?>
		<?php echo $form->error($topic,'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($forum->isNewRecord ? 'Отправить' : 'Изменить'); ?>
        <?php echo CHtml::button('Отмена', array(
            'onclick'=>'location.href="'.CHtml::normalizeUrl(array('forumlist/view', 'id' => $forumlist->id)).'";'
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->