<?php
/**
 * @var $categories Categories[]
 * @var $form CActiveForm
 * @var $title string
 */
?>
<?php foreach ($categories as $category):?>
    <h2><?php echo $category->title;?></h2>
    <table>
    <?php foreach ($category->typeFilter->extractParams() as $key => $value):?>
    <tr><td><?php echo $key;?></td><td><?php echo $value;?></td></tr>
    <?php endforeach;?>
    </table>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'filters-form',
        'enableAjaxValidation'=>false,
    )); ?>
    <?php echo CHtml::hiddenField('filter_id',$category->typeFilter->id);?>
        <?php echo CHtml::label('Ключ', 'key');?>
        <?php echo CHtml::textField('key',$title);?>
        <?php echo CHtml::label('Название', 'title');?>
        <?php echo CHtml::textField('title',$title);?>
        <?php echo CHtml::submitButton('Добавить');?>
    <?php $this->endWidget(); ?>
</div>
<?php endforeach;?>
