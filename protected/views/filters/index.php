<?php
$this->breadcrumbs=array(
	'Filters',
);

$this->menu=array(
	array('label'=>'Create Filters', 'url'=>array('create')),
	array('label'=>'Manage Filters', 'url'=>array('admin')),
);
?>

<h1>Filters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
