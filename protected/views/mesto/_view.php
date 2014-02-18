<?php
/**
 * @var Mesto $data
 */
?>
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
			        'Адресов(' . sizeof($data->maps) . '): ',
			        array(
			            'proezd/mesto',
			            'id' => $data->url        
			        )
			);?>
			<?php
			$pos = 0;
			foreach ($data->maps as $map) {
			    if ($pos++ < 4) {
                    if (Yii::app()->city->has_metro == 'yes') {
				        $this->renderPartial('/metro/_mesto',array('map' => $map));
                    } else {

                    }
			    }
			};
			?>
		<?php endif;?>
		</div>
		<div class="second"><?php echo CHtml::link(
            'Коментариев: '.($data->getCommentForum() ? $data->getCommentForum()->topic_count : 0),
            array('comments/mesto','id' => $data->url)
        );?></div>
	</div>
</div>