<?php
/**
 * @var $form CActiveForm
 * @var $model Mesto
 */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mesto-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'categories', array('class' => 'label')); ?>
        <?php foreach (Categories::model()->findAll() as $category):?>
        <?php echo $form->checkBox($model,'categories[]',array('value' => $category->id, 'checked' => isset($model->categories[$category->id]),'id' => 'category'.$category->id,'uncheckValue' => null)); ?>
        <?php echo CHtml::label($category->title, 'category'.$category->id);?>
        <?php endforeach;?>
        <?php echo $form->error($model,'categories'); ?>
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
		<?php echo $form->labelEx($model,'url', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
        <?php if($model->avatar):?>
            <img src="/images/mesto/<?php echo Yii::app()->city->folder;?>/<?php echo $model->avatar;?>" style="margin-left: 165px;">
            <br><br>
        <?php endif;?>
		<?php echo $form->labelEx($model,'avatar', array('class' => 'label')); ?>
		<?php echo $form->fileField($model,'avatar',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pages', array('class' => 'label')); ?>
        <?php foreach ($model->getPagesList() as $page => $title):?>
            <?php echo CHtml::checkBox('pages[]',$model->hasPage($page), array('value' => $page,'id' => 'page_'.$page)); ?>
            <?php echo CHtml::label($title,'page_'.$page);?>
        <?php endforeach;?>
		<?php echo $form->error($model,'pages'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enabled', array('class' => 'label')); ?>
		<?php echo $form->checkBox($model,'enabled'); ?>
		<?php echo $form->error($model,'enabled'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description', array('class' => 'label')); ?>
        <?php $this->widget('ext.RedactorJS.Redactor',array(
                'model'=>$model,
                'attribute'=>'description',
            ));?>
		<?php echo $form->error($model,'description'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->