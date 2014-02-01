<?php
/**
 * @var ForumsCats $model
 * @var CActiveDataProvider $provider
 * @var CListView $widget
 */
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
<?php if ($topics->getItemCount() != 0): ?>
<div class="paginator"><?php print $widget->renderPager();?></div>
<?php endif;?>

<div class="forumbuttons">
    <?php print CHtml::button('Ответить', array(
    'onclick' => 'location.href="' . CHtml::normalizeUrl(array('forums/reply','id'=>$model->id)) . '";'
));?>
</div>

<div class="forum_nav">
    <?php print CHtml::link('Форум', array('forumlist/index'));?>
    <b>&gt;</b>
    <?php print CHtml::link($model->forumCat->title, array('forumlist/view', 'id' => $model->forumCat->id));?>
    <b>&gt;</b>
    <?php print CHtml::link($model->title, array('forums/view', 'id' => $model->id));?>
</div>

<div class="topiclist">

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


<?php if ($topics->getItemCount() != 0): ?>
<div class="paginator">
    <?php print $widget->renderPager();?>
</div>
<?php endif;?>