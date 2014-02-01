<?php print $model->content;?>
<div class="mesta">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/mesto/_view',
)); ?>
	<div class="clear"></div>
</div>
<div class="filters gradient1">
    <div class="title">Фильтры</div>
    <?php foreach ($filters as $filter):?>
    <div class="filter">
        <div class="help">
            <div><?php print $filter->help;?></div>
        </div>
        <div class="name<?php if(!$filter->isEnabled($_GET)):?> disabled<?php endif;?>" 
            onclick="slideFilter(this, '<?php print $filter->key;?>')">
            <?php print $filter->title;?>
        </div>
        <div class="content"<?php if(!$filter->isEnabled($_GET)):?> style="display: none"<?php endif;?>>
            <?php $this->renderPartial('/filters/views/' . $filter->type, array(
                 'filter' => $filter
            ));?>
        </div>
    </div>
    <?php endforeach;?>
    <div class="submit">
        <input type="button" value="Применить" onclick="submitFilter()"/>
    </div>
</div>