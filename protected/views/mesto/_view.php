<div class="mesto gradient1">
	<div class="title">
		<?php echo CHtml::link(CHtml::encode($data->title), array(
			'mesto/view', 
			'id' => $data->url
		)); ?>
	</div>
	<?php echo CHtml::link(
			CHtml::image(
				'images/mesto/'.Yii::app()->city->folder.'/'.$data->avatar,
				CHtml::encode($data->title)
			),
			array(
				'mesto/view',
				'id' => $data->url
			)
		); ?>
	<div class="about">
		<div class="first">
		<?php if(sizeof($data->maps)>0):?>
			 <?php print CHtml::link(
			        'Метро(' . sizeof($data->maps) . '): ',
			        array(
			            'proezd/view',
			            'id' => $data->url        
			        )
			);?>
			<?php 
			$pos = 0;
			foreach ($data->maps as $map) {
			    if ($pos++ < 4) {
				    $this->renderPartial('/metro/_mesto',array('map' => $map));
			    }
			};
			?>
		<?php endif;?>
		</div>
		<div class="second"></div>
	</div>
</div>