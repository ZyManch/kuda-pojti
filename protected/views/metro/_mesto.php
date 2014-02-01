<?php if(sizeof($map->metro)):?>
    <?php $metro = $map->metro[0];?>
    <div class="metro <?php print $metro? $metro->line: 'undefined';?>">
    	<div>
    		<?php if ($metro):?>
    			<b>Станция:</b> <?php print $metro->title;?><br/>
    		<?php endif;?>
    		<?php if ($map->adress):?>
    			<b>Адрес:</b> <?php print $map->adress;?><br/>
    		<?php endif;?>
    		<?php if ($map->phones):?>
    			<b>Телефон:</b> <?php print $map->phones;?><br/>
    		<?php endif;?>
    	</div>
    </div>
<?php endif;?>