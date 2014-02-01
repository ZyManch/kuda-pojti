<?php $this->beginContent('//layouts/main'); ?>
<div id="pager">
	<?php foreach ($this->pages as $class => $config):?>
		<?php if($config['url']):?>
			<div class="page <?php print $class;?>">
			<?php print CHtml::link($config['label'], $config['url']);?>
			</div>
		<?php else:?>
			<div class="page">
			<?php print $config['label'];?>
			</div>
		<?php endif;?>
		
	<?php endforeach;?>
	<div id="pager_hidder"></div> 
</div>
<div id="container">
	<h1><?php print $this->pageTitle;?></h1>
	<?php echo $content; ?>
	<div style="clear: both"></div>
</div>
<?php $this->endContent(); ?>