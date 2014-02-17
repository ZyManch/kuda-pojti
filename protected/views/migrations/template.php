<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.02.14
 * Time: 18:48
 * @var MigrationQuery[] $commands
 * @var string $class_name
 */
?>
<?php echo '<?php';?>

class <?php echo $class_name;?> extends CDbMigration {

    public function up() {
<?php foreach ($commands as $command):?>
<?php $params = json_decode($command->params, 1);?>
<?php $keys = array_keys($params); $pk = reset($keys);?>
<?php if ($command->operation == 'insert'):?>
        $this->insert("<?php echo $command->table;?>",<?php var_export($params);?>);
<?php elseif ($command->operation == 'update'):?>
        $this->update("<?php echo $command->table;?>",<?php var_export($params);?>, "<?php echo $pk;?> = :pk",array("$pk" => <?php var_export($params[$pk]);?>));
<?php elseif ($command->operation == 'delete'):?>
        $this->delete("<?php echo $command->table;?>","<?php echo $pk;?> = :pk",array("$pk" => <?php var_export($params[$pk]);?>));
<?php endif;?>
<?php endforeach;?>
    }

    public function down() {

    }

}