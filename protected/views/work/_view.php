<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maps_id')); ?>:</b>
	<?php echo CHtml::encode($data->maps_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day_begin')); ?>:</b>
	<?php echo CHtml::encode($data->day_begin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day_end')); ?>:</b>
	<?php echo CHtml::encode($data->day_end); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_begin')); ?>:</b>
	<?php echo CHtml::encode($data->time_begin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_end')); ?>:</b>
	<?php echo CHtml::encode($data->time_end); ?>
	<br />


</div>