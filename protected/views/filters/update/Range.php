<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 15.02.14
 * Time: 20:00
 * @var $value
 * @var $model
 */
$value = explode("\n",$value,3);
?>
<div>
    <?php echo $form->label($model,'params[range][0]',array('label' => 'Левая граница')); ?>
    <?php echo $form->textField($model,'params[range][0]',array('value' => $value[0],'size' => 5)); ?>
</div>
<div>
    <?php echo $form->label($model,'params[range][1]',array('label' => 'Правая граница')); ?>
    <?php echo $form->textField($model,'params[range][1]',array('value' => $value[1],'size' => 5)); ?>
</div>
<div>
    <?php echo $form->label($model,'params[range][2]',array('label' => 'Текст фильтра')); ?>
    <?php echo $form->textField($model,'params[range][2]',array('value' => $value[2],'size' => 40)); ?>
</div>