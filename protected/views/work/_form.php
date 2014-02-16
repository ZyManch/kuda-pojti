<?php
/**
 * @var Work $work
 * @var CActiveForm $form
 * @var int $index
 */
$timeBegin = $work->time_begin;
$timeEnd = $work->time_end;
?>
<div>

    <?php echo $form->hiddenField($work,'['.$index.']id'); ?>
    <?php echo $form->hiddenField($work,'['.$index.']maps_id'); ?>

    <?php echo $form->labelEx($work,'['.$index.']day_begin', array('class' => 'label')); ?>
    <?php echo $form->dropDownList($work,'['.$index.']day_begin',$work->getDayVariants()); ?>

    <?php echo $form->labelEx($work,'['.$index.']day_end', array('class' => 'label')); ?>
    <?php echo $form->dropDownList($work,'['.$index.']day_end',$work->getDayVariants()); ?>

    <?php echo $form->labelEx($work,'['.$index.']time_begin', array('class' => 'label')); ?>
    <?php echo $form->textField($work,'['.$index.']time_begin', array('value' => sprintf('%02d:%02d',$timeBegin/60, $timeBegin % 60),'size' => 5)); ?>

    <?php echo $form->labelEx($work,'['.$index.']time_end', array('class' => 'label')); ?>
    <?php echo $form->textField($work,'['.$index.']time_end', array('value' => sprintf('%02d:%02d',$timeEnd/60, $timeEnd % 60),'size' => 5)); ?>
</div>