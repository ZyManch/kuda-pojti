<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 15.02.14
 * Time: 20:00
 * @var $value
 * @var $model
 */
$value = explode('=',$value,2);
?>
<div>
    <?php echo $form->textField($model,'params[list][keys][]',array('value' => $value[0])); ?>
    <?php echo $form->textField($model,'params[list][values][]',array('value' => $value[1])); ?>
    <?php echo CHtml::button('Удалить', array('onclick' => '$(this).parent().detach()'));?>
</div>