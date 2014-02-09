<?php
/**
 * @var $model Mesto
 * @var $this ProezdController
 */
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'maps-grid',
    'dataProvider'=>new CArrayDataProvider($model->maps),
    'columns'=>array(
        'id',
        'city',
        'structure',
        'adress',
        'street',
        'building',
        'office',
        'info',
        'phones',
        'map_x',
        'map_y',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
<h2>Добавить новое</h2>
<?php $this->renderPartial('_form', array('model' => $map));?>