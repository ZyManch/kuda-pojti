<p>
    Сайт куда пойти не гарантирует что <b>фотографии <?php print $model->title;?></b> соотвествуют
    действительности, так что маловероятно но все же возможно несоотвествие <i>внешнего или внутреннего вида
    <?php print $model->title;?></i> от реального.
</p>
<p>
    Если у вас есть дополнительные фотографии <?php print $model->title;?> можете отправить их на
    наш электронный адрес. 
</p>
<div id="gallery">
    <?php foreach ($images as $image):?>
        <div class="image">
            <?php print CHtml::link(
                CHtml::image($image->preview, $image->title),
                $image->url);?>
            <div class="name"><?php print $image->title;?></div>
        </div>
    <?php endforeach;?>
</div>
<?php Yii::app()->clientScript->registerScript('gallery', '
    $(function() {
        $("#gallery a").lightBox();
    });
');?>