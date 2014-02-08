<?php
$widget = $this->createWidget(
    'zii.widgets.CListView',
    array(
        'dataProvider'     => $topics,
        'itemView'         => '_view',
        'template'         => '{items}',
        'enablePagination' => true
    )
);
?>
<div class="forum_nav">
    <?php print CHtml::link('Форум', array('forumlist/index'));?>
    <b>&gt;</b>
    <?php print CHtml::link($forum->forumCat->title, array('forumlist/view', 'id' => $forum->forumCat->id));?>
    <b>&gt;</b>
    <?php print CHtml::link($forum->title, array('forums/view', 'id' => $forum->id));?>
    <b>&gt;</b>
    <?php print CHtml::link('Новое сообщение', array('forums/reply', 'id' => $forum->id));?>
</div>

<div id="container">
    <div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'forums-form',
        'enableAjaxValidation'=>false,
    )); ?>

        <p class="note">Поля отмеченые знаком <span class="required">*</span> обязательны для заполнения.</p>

        <?php echo $form->errorSummary($topic); ?>

        <div class="row">
            <?php echo $form->labelEx($topic,'content', array('class' => 'label')); ?>
            <?php echo $form->textArea($topic, 'content', array('rows'=>15, 'cols'=>133)); ?>
            <?php echo $form->error($topic,'content'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton($topic->isNewRecord ? 'Отправить' : 'Изменить'); ?>
            <?php echo CHtml::button('Отмена', array(
            'onclick'=>'location.href="'.CHtml::normalizeUrl(array('forums/view', 'id' => $forum->id)).'";'
        )); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>

    <div class="childforum">
        <?php if ($topics->getItemCount()==0): ?>
        <div class="forumrow">
            <div>Темы отсутствует</div>
        </div>
        <?php else: ?>
        <?php $widget->run(); ?>
        <?php endif; ?>
    </div>
</div>