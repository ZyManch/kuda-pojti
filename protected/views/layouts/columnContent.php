<?php $this->beginContent('//layouts/main'); ?>
<div id="container">
	<h1><?php print $this->pageTitle;?></h1>
	<?php echo $content; ?>
	<div style="clear: both"></div>
</div>
<?php $this->endContent(); ?>