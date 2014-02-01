<?php
$widget = $this->createWidget(
    'zii.widgets.CListView',
    array(
        'dataProvider'     => $topics,
        'itemView'         => '//forums/_view',
        'template'         => '{items}',
        'enablePagination' => true
    )
);
?>
<?php if ($topics->getItemCount() != 0): ?>
<div class="paginator"><?php print $widget->renderPager();?></div>
<?php endif;?>

<div class="topiclist">

    <?php if (!Yii::app()->user->isGuest): ;?>
        <?php $this->renderPartial('_form', array('model' => $topic));?>
    <?php else: ?>
        <b>Комментарии имеют право оставлять только зарегистрированные пользователи</b>
    <?php endif;?>

    <?php if ($topics->getItemCount()==0): ?>
        <div class="forumrow">
            <div>Комментарии отсутствуют</div>
        </div>
    <?php else: ?>
        <?php $widget->run(); ?>
    <?php endif; ?>

</div>


<?php if ($topics->getItemCount() != 0): ?>
<div class="paginator">
    <?php print $widget->renderPager();?>
</div>
<?php endif;?>