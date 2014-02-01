<div class="forum_nav">
    <?php print CHtml::link('Форум', array('forumlist/index'));?>
    <b>&gt;</b>
    <?php print CHtml::link($forumlist->title, array('forumlist/view', 'id' => $forumlist->id));?>
    <b>&gt;</b>
    <?php print CHtml::link('Новая тема', array('forums/create', 'id' => $forumlist->id));?>
</div>

<div id="container">
    <?php echo $this->renderPartial('_form', array(
        'forum'=>$forum,
        'topic'=>$topic,
        'forumlist'=>$forumlist
    )); ?>
</div>