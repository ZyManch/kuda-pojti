<?php

/**
 * Модель таблицы "metro".
 *
 * У таблицы 'metro' следующие поля:
 * @property integer $id
 * @property string $line
 * @property string $title
 * @property double $map_x
 * @property double $map_y
 */
class Metro extends ActiveRecord {

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'metro';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('line, title, map_x, map_y', 'required'),
			array('map_x, map_y, forum_id', 'numerical'),
			array('line', 'length', 'max'=>7),
			array('title', 'length', 'max'=>32)
		);
	}

	/**
	 * @return array связи с другими моделями.
	 */
	public function relations() {
		return array(
		);
	}

	/**
	 * @return array название полей
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'line' => 'Line',
			'title' => 'Title',
			'map_x' => 'Map X',
			'map_y' => 'Map Y',
		);
	}

}