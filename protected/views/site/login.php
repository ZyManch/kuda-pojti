<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Поля со знаком <span class="required">*</span> обязательны для заполнения.</p>
<table width="280px">
	<tr>
		<td class="message_label" width="60px">
            <?php echo $form->labelEx($model,'email'); ?>
        </td>
        <td>
            <?php echo $form->textField($model,'email'); ?>
            <?php echo $form->error($model,'email'); ?>
        </td>
	</tr>

	<tr>
        <td class="message_label">
            <?php echo $form->labelEx($model,'pass'); ?>

        </td>
        <td>
            <?php echo $form->passwordField($model,'pass'); ?>
            <?php echo $form->error($model,'pass'); ?>
        </td>
	</tr>

	<tr>
        <td>&nbsp;</td>
        <td>
            <?php echo $form->label($model,'rememberMe'); ?>
            <?php echo $form->checkBox($model,'rememberMe'); ?>
        </td>
	</tr>

	<tr>
        <td>&nbsp;</td>
        <td>
		    <?php echo CHtml::submitButton('Войти'); ?>
        </td>
	</tr>
</table>
<?php $this->endWidget(); ?>