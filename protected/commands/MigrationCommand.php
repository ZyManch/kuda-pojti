<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.02.14
 * Time: 17:05
 */
Yii::import('system.cli.commands.MigrateCommand');
class MigrationCommand extends MigrateCommand {

    public function beforeAction($action,$params) {
        $this->migrationPath='application.migrations.'.Yii::app()->city->folder;
        parent::beforeAction($action, $params);
        return true;
    }

    public function actionSave() {
        $this->interactive = false;
        $commands = MigrationQuery::model()->findAll(array('order' => 'created DESC'));
        if (!$commands) {
            echo "Изменения не найдены";
            return;
        }
        $this->_saveMigration($commands);
    }

    public function actionExport($table, $columns) {
        $this->interactive = false;
        $commands = array();
        $items = Yii::app()->db->createCommand()->
            select($columns)->
            from($table)->
            queryAll();

        foreach ($items as $item) {
            $command = new MigrationQuery();
            $command->operation = 'insert';
            $command->table = $table;
            $command->params = json_encode($item);
            $commands[] = $command;
        }
        $this->_saveMigration($commands);
    }

    protected function _saveMigration($commands) {
        $this->templateFile = 'app.views.migrations.template';
        $name='m'.gmdate('ymd_His').'_UpdateData';
        $content = $this->renderFile(
            Yii::getPathOfAlias('application.views.migrations.template').'.php',
            array(
                'class_name' => $name,
                'commands' => $commands,
            ),
            true
        );
        $file=$this->migrationPath.DIRECTORY_SEPARATOR.$name.'.php';
        file_put_contents($file, $content);
    }

}