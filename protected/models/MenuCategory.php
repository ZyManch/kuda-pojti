<?php

/**
 * Модель таблицы "menu_category".
 *
 * У таблицы 'menu_category' следующие поля:
 * @property string $id
 * @property string $url
 * @property string $title
 * @property string $settings
 * @property Menu[] $menu
 */
class MenuCategory extends ActiveRecord {

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'menu_category';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('url, title, settings', 'required'),
			array('url', 'length', 'max'=>32),
			array('title', 'length', 'max'=>64),
			array('id, url, title, settings', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array связи с другими моделями.
	 */
	public function relations() {
		return array(
            'menu' => array(self::HAS_MANY,'Menu','menu_category_id','order' => 'price ASC')
		);
	}

	/**
	 * @return array название полей
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'url' => 'Url',
			'title' => 'Title',
			'settings' => 'Settings',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('settings',$this->settings,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}