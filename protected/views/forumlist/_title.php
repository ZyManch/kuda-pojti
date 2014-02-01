<?php
/**
 * @var ForumsCats $forum
 * @var bool $showForumCount
 */
?>
<div class="mainforum">
    <div class="title">
        <?php print $forum->title;?>
    </div>

    <?php if ($showForumCount): ?>
    <div class="forums"><?php print $forum->getAttributeLabel('forum_count');?></div>
    <?php endif;?>

    <div class="topics"><?php print $forum->getAttributeLabel('topic_count');?></div>

    <div><?php print $forum->getAttributeLabel('last_user_id');?></div>
</div>