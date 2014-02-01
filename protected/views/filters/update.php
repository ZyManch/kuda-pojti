<?php
$this->breadcrumbs=array(
	'Filters'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Filters', 'url'=>array('index')),
	array('label'=>'Create Filters', 'url'=>array('create')),
	array('label'=>'View Filters', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Filters', 'url'=>array('admin')),
);
?>

<h1>Update Filters <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>