<?php
/**
 * @var $model Mesto
 */
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'work-form',
    'enableAjaxValidation'=>false,
));
foreach ($model->maps as $map):?>
    <hr>
    <h2><?php echo $map->adress;?></h2>
    <?php foreach ($map->work as $index => $work):?>
        <?php $this->renderpartial('_form', array('form' => $form,'work' => $work,'index' => $index));?>
    <?php endforeach;?>
    <?php echo CHtml::button('Добавить', array('onclick' => '$($("#blank").html().split("%").join(Math.round(Math.random()*1000000))).insertBefore(this)'));?>
<?php endforeach; ?>
 <?php echo CHtml::submitButton('Сохранить');?>
<?php $this->endWidget(); ?>
<div id="blank" style="display: none">
    <?php
    $work = new Work();
    $work->maps_id = $map->id;
    ?>
    <?php $this->renderpartial('_form', array('form' => $form,'work' => $work,'index' => '%'));?>
</div>
