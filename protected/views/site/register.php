<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'register-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<p class="note">Поля со знаком <span class="required">*</span> обязательны для заполнения.</p>
<table width="390px">
    <tr>
        <td class="message_label" width="125px">
            <?php echo $form->labelEx($model,'name'); ?>
        </td>
        <td>
            <?php echo $form->textField($model,'name'); ?>
            <?php echo $form->error($model,'name'); ?>
        </td>
    </tr>

    <tr>
        <td class="message_label">
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
        <td class="message_label">
            <?php echo $form->labelEx($model,'pass2'); ?>

        </td>
        <td>
            <?php echo $form->passwordField($model,'pass2'); ?>
            <?php echo $form->error($model,'pass2'); ?>
        </td>
    </tr>

    <tr>
        <td>&nbsp;</td>
        <td>
            <?php echo CHtml::submitButton(
                'Зарегистрироваться',
                array(
                    'submit' => 'site/register',
                    'params' => array(
                        'reg'=>'new',
                        'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken
                    )
                )
            ); ?>
        </td>
    </tr>
</table>
<?php $this->endWidget(); ?>