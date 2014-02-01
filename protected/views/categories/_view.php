<div class="category gradient1">
    
    <img src="images/categories/<?php print $data->avatar;?>"/>
    
    <?php echo CHtml::link(
                CHtml::encode($data->title), 
                array('view', 'id'=>$data->url),
                array('class'=>'title')
    ); ?>
    <br />

    <?php echo CHtml::encode($data->content); ?>
    <ul class="filter">
        <?php foreach ($data->getTypeFilter() as $key=>$value): ?>
            <li><?php print CHtml::link($value,array(
                    'categories/view',
                    'id'   =>$data->url,
                    'type' => $key
                  )
            ); ?></li>
        <?php endforeach;?>
    </ul>
</div>