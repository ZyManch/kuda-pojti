<?php

/**
 * Модель таблицы "mesto_cats".
 *
 * У таблицы 'mesto_cats' следующие поля:
 * @property integer $id
 * @property integer $mesto_id
 * @property integer $category_id
 */
class MestoCats extends ActiveRecord {

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'mesto_cats';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('mesto_id, category_id', 'required'),
			array('mesto_id, category_id', 'numerical', 'integerOnly'=>true),
			array('id, mesto_id, category_id', 'safe', 'on'=>'search'),
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
			'mesto_id' => 'Mesto',
			'category_id' => 'Category',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('mesto_id',$this->mesto_id);
		$criteria->compare('category_id',$this->category_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}