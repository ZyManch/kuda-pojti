<div class="topic">
    <div class="user">
        <?php print CHtml::link($data->autor->name, array('users/view', 'id'=>$data->autor->id));?>
        <br/>
        <?php print CHtml::image('images/users/' . $data->autor->avatar,'');?>
    </div>

    <div class="content">
	    <?php echo $data->content; ?>
    </div>
</div>