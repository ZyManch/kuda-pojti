<?php

/**
 * Модель таблицы "filters_skiped".
 *
 * У таблицы 'filters_skiped' следующие поля:
 * @property string $id
 * @property string $key
 */
class FiltersSkiped extends ActiveRecord {

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'filters_skiped';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('key', 'required'),
			array('key', 'length', 'max'=>32),
			array('id, key', 'safe', 'on'=>'search'),
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
			'key' => 'Key',
		);
	}

	/**
	 * Осуществляет поиск по таблице.
	 * @return CActiveDataProvider 
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('key',$this->key,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}