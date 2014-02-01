<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('line')); ?>:</b>
	<?php echo CHtml::encode($data->line); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('map_x')); ?>:</b>
	<?php echo CHtml::encode($data->map_x); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('map_y')); ?>:</b>
	<?php echo CHtml::encode($data->map_y); ?>
	<br />


</div>