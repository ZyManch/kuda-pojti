<?php
/**
 * @var ForumsCats $data
 * @var boolean $showForumCount
 */
?>
<div class="forumrow">
    <div class="icon">
        <?php if(isset($data->avatar) && $data->avatar): ?>
        <?php print CHtml::image(
            'images/forum/' . $data->avatar . '.png',
            '',
            array('width' => 32, 'height'=>32)
        ); ?>
        <?php endif;?>
    </div>
    <div class="name">
        <?php if ($showForumCount):?>
            <?php print CHtml::link($data->title, array('forumlist/view','id'=>$data->id));?>
        <?php else: ?>
            <?php print CHtml::link($data->title, array('forums/view','id'=>$data->id));?>
        <?php endif;?>
    </div>
    <?php if ($showForumCount): ?>
        <div class="forums"><?php print $data->forum_count;?></div>
    <?php endif;?>
    <div class="topics"><?php print $data->topic_count;?></div>
    <div>
        <?php
        print $data->last_user_id ?
            CHtml::link($data->lastUser->name, array('users/update', 'id'=>$data->lastUser->id)) .
                ', ' . Yii::app()->dateFormatter->formatDateTime($data->changed, 'long',null):
            'отсутствует';
        ?>
    </div>
</div>