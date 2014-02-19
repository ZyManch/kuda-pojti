<?php

/**
 * Модель таблицы "menu".
 *
 * У таблицы 'menu' следующие поля:
 * @property string $id
 * @property string $title
 * @property string $mesto_id
 * @property integer $menu_category_id
 * @property double $price
 * @property integer $value
 * @property string $description
 * @property string $changed
 * @property MenuCategory $menuCategory
 */
class Menu extends ActiveRecord {

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'menu';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('title, mesto_id, menu_category_id, price, value, description, changed', 'required'),
			array('menu_category_id, value', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('title', 'length', 'max'=>32),
			array('mesto_id', 'length', 'max'=>10),
			array('id, title, mesto_id, menu_category_id, price, value, description, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array связи с другими моделями.
	 */
	public function relations() {
		return array(
            'menuCategory' => array(self::BELONGS_TO,'MenuCategory','menu_category_id')
		);
	}

	/**
	 * @return array название полей
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'mesto_id' => 'Mesto',
			'menu_category_id' => 'Menu Category',
			'price' => 'Price',
			'value' => 'Value',
			'description' => 'Description',
			'changed' => 'Changed',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('mesto_id',$this->mesto_id,true);
		$criteria->compare('menu_category_id',$this->menu_category_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('value',$this->value);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}