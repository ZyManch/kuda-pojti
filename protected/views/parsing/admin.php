
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'parsing-data-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'selectionChanged' => 'function(id){ location.href = "'.$this->createUrl('parsing/update', array('id' => '')).'"+$.fn.yiiGridView.getSelection(id);}',
    'rowCssClassExpression' => function ($index, $data) {
            $data->validate();
            return $data->hasErrors() ? "error" : "success";
    },
	'columns'=>array(
		'id',
        'name',
		'x',
		'y',
		'address',
		'categories',
        array(
            'header' => 'Errors',
            'type' => 'raw',
            'value' => function($data) {
                /** @var $data ParsingData */
                $result = array();
                foreach ($data->getErrors() as $value) {
                    $result[] = implode('. <br>', $value);
                }
                return implode('. ', $result);
            }
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update} {delete}'
		),
	),
)); ?>
