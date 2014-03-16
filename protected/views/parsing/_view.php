<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('parsing_data_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->parsing_data_id), array('view', 'id'=>$data->parsing_data_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('search_text')); ?>:</b>
	<?php echo CHtml::encode($data->search_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('x')); ?>:</b>
	<?php echo CHtml::encode($data->x); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('y')); ?>:</b>
	<?php echo CHtml::encode($data->y); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('categories')); ?>:</b>
	<?php echo CHtml::encode($data->categories); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('work')); ?>:</b>
	<?php echo CHtml::encode($data->work); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('phones')); ?>:</b>
	<?php echo CHtml::encode($data->phones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('filters')); ?>:</b>
	<?php echo CHtml::encode($data->filters); ?>
	<br />

	*/ ?>

</div>