<?php if(!isset($onclick)) $onclick = 'function(key){}';?>
<div class="select">
	<div class="options">
		<?php foreach ($items as $key=>$value):?>
		<div key="<?php print $key;?>" 
			class="option<?php print $key==$selected?' checked':'';?>" 
			onmouseup="return optionClick(<?php print $onclick; ?>,this)">
			<?php print CHtml::encode($value);?>
		</div>
		<?php endforeach;?>	
	</div>
	<div class="selected" onclick="return selectedClick(this)">
		<?php if(isset($items[$selected])):?>
		<?php print CHtml::encode($items[$selected]);?>
		<?php else:?>
		&lt;пусто&gt;
		<?php endif;?>
	</div>	
</div>