<?php

/**
 * Модель таблицы "parsing_data".
 *
 * У таблицы 'parsing_data' следующие поля:
 * @property string $parsing_data_id
 * @property string $search_text
 * @property string $x
 * @property string $y
 * @property string $address
 * @property string $categories
 * @property string $work
 * @property string $phones
 * @property string $name
 * @property integer $url
 * @property string $filters
 */
class ParsingData extends ActiveRecord {

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'parsing_data';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('search_text, x, y, address, categories, work, phones, name, url, filters', 'required'),
			array('url', 'numerical', 'integerOnly'=>true),
			array('search_text', 'length', 'max'=>64),
			array('x, y', 'length', 'max'=>19),
			array('name', 'length', 'max'=>128),
			array('parsing_data_id, search_text, x, y, address, categories, work, phones, name, url, filters', 'safe', 'on'=>'search'),
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
			'parsing_data_id' => 'Parsing Data',
			'search_text' => 'Search Text',
			'x' => 'X',
			'y' => 'Y',
			'address' => 'Address',
			'categories' => 'Categories',
			'work' => 'Work',
			'phones' => 'Phones',
			'name' => 'Name',
			'url' => 'Url',
			'filters' => 'Filters',
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

		$criteria->compare('parsing_data_id',$this->parsing_data_id,true);
		$criteria->compare('search_text',$this->search_text,true);
		$criteria->compare('x',$this->x,true);
		$criteria->compare('y',$this->y,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('categories',$this->categories,true);
		$criteria->compare('work',$this->work,true);
		$criteria->compare('phones',$this->phones,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url);
		$criteria->compare('filters',$this->filters,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}