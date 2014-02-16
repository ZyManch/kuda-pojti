<?php

/**
 * Модель таблицы "migration_query".
 *
 * У таблицы 'migration_query' следующие поля:
 * @property string $id
 * @property string $operation
 * @property string $table
 * @property integer $params
 * @property string $created
 */
class MigrationQuery extends ActiveRecord {

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'migration_query';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('table, operation, params', 'required'),
			array('params', 'safe'),
			array('operation', 'length', 'max'=>6),
			array('table', 'length', 'max'=>32),
			array('created', 'length', 'max'=>18),
			array('id, operation, table, params, created', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array название полей
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'operation' => 'Operation',
			'table' => 'Table',
			'params' => 'Params',
			'created' => 'Created',
		);
	}

}