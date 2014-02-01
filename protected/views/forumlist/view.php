<?php
/**
 * @var ForumsCats $model
 * @var CActiveDataProvider $provider
 * @var CListView $widget
 */
$widget = $this->createWidget(
    'zii.widgets.CListView',
    array(
        'dataProvider'     => $provider,
        'viewData'         => array(
            'showForumCount' => false
        ),
        'itemView'         => '_view',
        'template'         => '{items}',
        'enablePagination' => true
    )
);
?>

<?php if ($provider->getItemCount() != 0): ?>
    <div class="paginator"><?php print $widget->renderPager();?></div>
<?php endif;?>

<?php if ($model->visible == 'Yes'): ?>
    <div class="forumbuttons">
        <?php print CHtml::button('Создать тему', array(
            'onclick' => 'location.href="' . CHtml::normalizeUrl(array('forums/create','id'=>$model->id)) . '";'
        ));?>
    </div>
<?php endif;?>

<div class="forum_nav">
    <?php print CHtml::link('Форум', array('forumlist/index'));?>
    <b>&gt;</b>
    <?php print CHtml::link($model->title, array('forumlist/view', 'id' => $model->id));?>
</div>

<div class="topiclist">

    <?php print $this->renderPartial('//forumlist/_title',
        array('forum' => $model, 'showForumCount' => false)
    );?>

    <div class="childforum">
        <?php if ($provider->getItemCount()==0): ?>
            <div class="forumrow">
                <div>Темы отсутствует</div>
            </div>
        <?php else: ?>
            <?php $widget->run(); ?>
        <?php endif; ?>
    </div>
</div>


<?php if ($provider->getItemCount() != 0): ?>
    <div class="paginator">
        <?php print $widget->renderPager();?>
    </div>
<?php endif;?>