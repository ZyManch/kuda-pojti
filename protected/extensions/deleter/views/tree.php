<li>
    <?php print '[' . $tree['class'] . '] ' . $tree['title'];?>
    <?php if($tree['relations']) : ?>
        <ul>
            <?php foreach ($tree['relations'] as $relation):?>
                <?php foreach ($relation as $item):?>
                    <?php print $this->render('tree', array(
                        'tree' => $item
                    ));?>
                <?php endforeach;?>
            <?php endforeach;?>
        </ul>
    <?php endif;?>
</li>