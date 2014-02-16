<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.02.14
 * Time: 17:05
 */
Yii::import('system.cli.commands.MigrateCommand');
class MigrationCommand extends MigrateCommand {

    public function actionSave() {
        $this->interactive = false;
        $d = new CDbCriteria();
        $commands = MigrationQuery::model()->findAll(array('order' => 'created DESC'));
        if (!$commands) {
            echo "Изменения не найдены";
            return;
        }
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
        print $content;return;
        $file=$this->migrationPath.DIRECTORY_SEPARATOR.$name.'.php';
        file_put_contents($file, $content);
    }

}