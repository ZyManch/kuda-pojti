<?php print CHtml::image(
	'images/mesto/'.Yii::app()->city->folder.'/'.$model->avatar,
	$model->title,
	array(
		'class' => 'avatar'
	)
);?>
<div id="mesto_info">
    <h2>Детальная информация</h2>
    <?php $filters = Filters::getListByMesto($model->id);?>
    <?php foreach ($filters as $filter):?>
       <?php if ($html = $filter->htmlInfo()) :?>
           <b><?php print $filter->title;?></b>
           <?php print $html;?><br/>
       <?php endif;?>
    <?php endforeach;?>
</div>

<div id="mesto_content">
    <h2>Описание</h2>
    <?php if ($model->content):?>
        <?php print $model->content;?>
    <?php else:?>
        Описаний нет
    <?php endif;?>
</div>
