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
        <?php if ($command->operation == 'insert'):?>
        $this->insert("<?php echo '';?>",);
        <?php elseif ($command->operation == 'update'):?>

        <?php elseif ($command->operation == 'delete'):?>

        <?php endif;?>
        <?php endforeach;?>
    }

    public function down() {

    }

}