<?php

/**
 * Модель таблицы "images".
 *
 * У таблицы 'images' следующие поля:
 * @property integer $id
 * @property integer $mesto_id
 * @property string $title
 * @property string $preview
 * @property string $url
 * @property integer $width
 * @property integer $height
 */
class Images extends ActiveRecord {

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'images';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('mesto_id, title, preview, url, width, height', 'required'),
			array('mesto_id, width, height', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>64),
			array('preview, url', 'length', 'max'=>128),
			array('id, mesto_id, title, preview, url, width, height', 'safe', 'on'=>'search'),
		);
	}

    public function behaviors(){
        return array(
            'migration' => array(
                'class' => 'MigrationBehavior',
            ),
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
			'title' => 'Title',
			'preview' => 'Preview',
			'url' => 'Url',
			'width' => 'Width',
			'height' => 'Height',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('preview',$this->preview,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('width',$this->width);
		$criteria->compare('height',$this->height);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}