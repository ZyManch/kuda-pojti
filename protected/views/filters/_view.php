<div class="view-element gradient1">

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('help')); ?>:</b>
	<?php echo CHtml::encode($data->help); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::link($data->category->title, array('categories/view', 'id' => $data->category->url)); ?>
    <br />
    <?php echo CHtml::button('Редактировать', array('onclick' => 'location.href="'.CHtml::normalizeUrl(array('update','id' => $data->id)).'"'));?>

</div>