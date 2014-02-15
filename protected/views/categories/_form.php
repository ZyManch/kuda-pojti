<?php
/**
 * @var $form CActiveForm
 * @var $model Categories
 */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categories-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content', array('class' => 'label')); ?>
        <?php $this->widget('ext.RedactorJS.Redactor',array(
                'model'=>$model,
                'attribute'=>'content',
            ));?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model,'description', array('class' => 'label')); ?>
        <?php $this->widget('ext.RedactorJS.Redactor',array(
            'model'=>$model,
            'attribute'=>'description',
        ));?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

    <div class="row">
        <?php if ($model->typeFilter):?>
            <?php echo $form->labelEx($model,'filter', array('class' => 'label')); ?>
            <?php foreach ($model->getTypeFilter() as $key => $value):?>
                <?=CHtml::link($value, array('categories/view', 'id' => $model->url,'type' => $key));?>,
            <?php endforeach;?>
            <?php echo CHtml::button('Редактировать',array('onclick' => "location.href='/filters/update/".$model->typeFilter->id."';"));?>
        <?php endif;?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'avatar', array('class' => 'label')); ?>
		<?php echo $form->dropDownList(
            $model,
            'avatar',
            $model->getAvatarList(),
            array('onchange' => 'js:$("#avatar").attr("src","/images/categories/"+this.value);')
        ); ?>
		<?php echo $form->error($model,'avatar'); ?>
        <?php Yii::app()->clientScript->registerScript('load-avcatar','$("#Categories_avatar").trigger("change");');?>
        <?php echo CHtml::image('','', array('id' => 'avatar'));?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'position', array('size' => 3)); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->