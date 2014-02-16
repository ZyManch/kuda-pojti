<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.02.14
 * Time: 14:46
 */
class MigrationBehavior extends CActiveRecordBehavior {

    public function beforeSave($event) {
        /** @var ActiveRecord $owner */
        $owner = $this->getOwner();
        $migration = new MigrationQuery();
        $migration->table = $owner->tableName();
        $migration->params = json_encode($owner->attributes);
        if ($owner->getIsNewRecord()) {
            $migration->operation = 'insert';
        } else {
            $migration->operation = 'update';
        }
        if (!$migration->save(false)) {
            $error = $owner->getErrors();
            throw new Exception('Ошибки в полях миграции:'.implode(',',array_keys($error)));
        }
        return true;
    }

    public function beforeDelete($event) {
        /** @var ActiveRecord $owner */
        $owner = $this->getOwner();
        $migration = new MigrationQuery();
        $migration->table = $owner->tableName();
        $migration->params = json_encode(array(
            $owner->getMetaData()->tableSchema->primaryKey =>  $owner->getPrimaryKey()
        ));
        $migration->operation = 'delete';
        if (!$migration->save()) {
            $error = $owner->getErrors();
            throw new Exception('Ошибки в полях миграции:'.implode(',',array_keys($error)));
        }
        return true;
    }

}