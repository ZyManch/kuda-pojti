<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.02.14
 * Time: 12:00
 * @var $model Mesto
 * @var $images Images[]
 */
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'categories-grid',
    'dataProvider'=>new CArrayDataProvider($images),
    'columns'=>array(
        'id',
        'title',
        array(
            'name' => 'preview',
            'type' => 'raw',
            'value' => function($data) {
                return CHtml::image($data->preview);
            }
        ),
        'width',
        'height',
        array(
            'class'=>'CButtonColumn',
            'viewButtonUrl'=>'Yii::app()->controller->createUrl("view",array("id"=>$data->url))',
            'updateButtonUrl'=>'Yii::app()->controller->createUrl("update",array("id"=>$data->url))',
            'deleteButtonUrl'=>'Yii::app()->controller->createUrl("delete",array("id"=>$data->url))',
        ),
    ),
));?>
<h2>Добавить новые изображения</h2>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'mesto-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data')
)); ?>

<?php for ($i=0; $i< 20; $i++):?>
<div class="row">
    <label class="label" for="lab">Изображение <?php echo $i+1;?></label>
    <input name="gallery[<?=$i;?>]" type="text" value="<?php echo htmlspecialchars($model->title);?>">
    <input name="gallery[<?=$i;?>]" type="file">
</div>
<?php endfor;?>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Загрузить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
