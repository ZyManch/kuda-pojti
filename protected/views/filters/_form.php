<?php
/**
 * @var $model Filters
 * @var $form CActiveForm
 */
Yii::app()->clientScript->registerScript(
    'change-type',
    '$("#FiltersMulty_type").change(function() {
        var options = '.json_encode($model->getFormatsOfParam()).';
        $(".params").hide();
        $("#"+options[$(this).val()]).show();
    });',
        CClientScript::POS_READY
);
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'filters-form',
	'enableAjaxValidation'=>false,
)); ?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'help', array('class' => 'label')); ?>
        <?php $this->widget('ext.RedactorJS.Redactor',array(
                'model'=>$model,
                'attribute'=>'help',
            ));?>
		<?php echo $form->error($model,'help'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type', array('class' => 'label')); ?>
		<?php echo $form->dropDownList($model,'type',$model->getTypeVariants()); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'params', array('class' => 'label')); ?>
        <div class="field params" id="list"<?php if($model->getFormatOfParam() != 'list'):?> style="display: none"<?php endif;?>>
            <?php foreach (explode("\n", $model->params) as $value):?>
                <?php $this->renderpartial('update/List',array('form' => $form,'value' => $value, 'model' => $model));?>
            <?php endforeach;?>
            <div id="blank" style="display: none">
            <?php $this->renderpartial('update/List',array('form' => $form,'value' => '=', 'model' => $model));?>
            </div>
            <?php echo CHtml::button('Добавить', array('onclick' => '$($("#blank").html()).insertBefore(this)'));?>
        </div>
        <div class="field params" id="range"<?php if($model->getFormatOfParam() != 'range'):?> style="display: none"<?php endif;?>>
            <?php $this->renderpartial('update/Range',array('form' => $form, 'model' => $model));?>
        </div>
        <div class="field params" id="empty"<?php if($model->getFormatOfParam() != 'empty'):?> style="display: none"<?php endif;?>>
            <?php $this->renderpartial('update/Empty',array('form' => $form, 'model' => $model));?>
        </div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id', array('class' => 'label')); ?>
		<?php echo $form->dropDownList($model,'category_id',CHtml::listData(Categories::model()->findAll(),'id','title'),array('empty' => 'Общий')); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'key', array('class' => 'label')); ?>
        <?php echo $form->textField($model,'key',array()); ?>
        <?php echo $form->error($model,'key'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'king', array('class' => 'label')); ?>
		<?php echo $form->dropDownList($model,'king',$model->getKingVariants()); ?>
		<?php echo $form->error($model,'king'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position', array('class' => 'label')); ?>
		<?php echo $form->textField($model,'position', array('size' => 4)); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->