<?php

/**
 * Модель таблицы "mesto_filters".
 *
 * У таблицы 'mesto_filters' следующие поля:
 * @property integer $id
 * @property integer $mesto_id
 * @property integer $filter_id
 * @property integer $range_from
 * @property integer $range_to
 * @property string $value
 */
class MestoFilters extends ActiveRecord {

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'mesto_filters';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('mesto_id, filter_id', 'required'),
			array('mesto_id, filter_id, range_from, range_to', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>24),
			array('id, mesto_id, filter_id, range_from, range_to, value', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array связи с другими моделями.
	 */
	public function relations() {
		return array(
		    'filters' => array(self::BELONGS_TO, 'Filters', 'filter_id')
		);
	}

	/**
	 * @return array название полей
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'mesto_id' => 'Mesto',
			'filter_id' => 'Filter',
			'range_from' => 'Range From',
			'range_to' => 'Range To',
			'value' => 'Value',
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
		$criteria->compare('filter_id',$this->filter_id);
		$criteria->compare('range_from',$this->range_from);
		$criteria->compare('range_to',$this->range_to);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}