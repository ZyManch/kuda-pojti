<?php
/**
 * @var array $forums
 */
?>
<?php foreach ($forums as $forum): ?>
        <div class="topiclist">

            <?php print $this->renderPartial('//forumlist/_title',
                array('forum' => $forum, 'showForumCount' => true)
            );?>

            <div class="childforum">
                <?php foreach ($forum->childs as $item): ?>

                    <?php print $this->renderPartial('//forumlist/_view',
                        array('data' => $item, 'showForumCount' => true)
                    );?>

                <?php endforeach; ?>
            </div>
        </div>
<?php endforeach; ?>