<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mesto_id')); ?>:</b>
	<?php echo CHtml::encode($data->mesto_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adress')); ?>:</b>
	<?php echo CHtml::encode($data->adress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phones')); ?>:</b>
	<?php echo CHtml::encode($data->phones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('map_x')); ?>:</b>
	<?php echo CHtml::encode($data->map_x); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('map_y')); ?>:</b>
	<?php echo CHtml::encode($data->map_y); ?>
	<br />


</div>