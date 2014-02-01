<?php
$this->breadcrumbs=array(
	'Filters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Filters', 'url'=>array('index')),
	array('label'=>'Manage Filters', 'url'=>array('admin')),
);
?>

<h1>Create Filters</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>