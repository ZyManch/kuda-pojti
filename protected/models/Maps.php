<?php

/**
 * Модель таблицы "maps".
 *
 * У таблицы 'maps' следующие поля:
 * @property integer $id
 * @property integer $mesto_id
 * @property string $adress
 * @property string $phones
 * @property double $map_x
 * @property double $map_y
 * @property Work[] $work
 */
class Maps extends ActiveRecord {

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'maps';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('mesto_id, city,structure, adress, map_x, map_y', 'required'),
            array('city,info,adress,structure, 	street,building, phones, office,','safe'),
			array('mesto_id', 'numerical', 'integerOnly'=>true),
			array('map_x, map_y', 'numerical'),
			array('id, mesto_id, adress, phones, map_x, map_y', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array связи с другими моделями.
	 */
	public function relations() {
		return array(
			'metro' => array(self::MANY_MANY, 'Metro', 'maps_metro(maps_id, metro_id)'),
		    'work'  => array(self::HAS_MANY, 'Work', 'maps_id','index' => 'id'),
		    'mesto'  => array(self::BELONGS_TO, 'Mesto', 'mesto_id'),
		);
	}

	/**
	 * @return array название полей
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'mesto_id' => 'Заведение',
			'city' => 'Город',
			'structure' => 'Тип',
			'adress' => 'Название улицы',
			'street' => 'Дом пол улице',
			'building' => 'Строение',
			'office' => 'Офис',
			'phones' => 'Телефоны',
			'map_x' => 'Координата X',
			'map_y' => 'Координата Y',
		);
	}

    public function getStructureVariants() {
        return array(
            'Улица' => 'Улица',
            'Переулок' => 'Переулок',
            'Бульвар' => 'Бульвар',
            'Площадь' => 'Площадь',
            'Проспект' => 'Проспект',
            'Проезд' => 'Проезд',
            'Тупик' => 'Тупик',
            'Шоссе' => 'Шоссе',
            'Набережная' => 'Набережная',
            'Вал' => 'Вал',
            'Парк' => 'Парк'
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
		$criteria->compare('adress',$this->adress,true);
		$criteria->compare('phones',$this->phones,true);
		$criteria->compare('map_x',$this->map_x);
		$criteria->compare('map_y',$this->map_y);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}