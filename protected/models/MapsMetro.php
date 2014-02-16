<?php

/**
 * Модель таблицы "maps_metro".
 *
 * У таблицы 'maps_metro' следующие поля:
 * @property integer $id
 * @property integer $maps_id
 * @property integer $metro_id
 */
class MapsMetro extends ActiveRecord {

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'maps_metro';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('maps_id, metro_id', 'required'),
			array('maps_id, metro_id', 'numerical', 'integerOnly'=>true),
			array('id, maps_id, metro_id', 'safe', 'on'=>'search'),
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
			'maps_id' => 'Maps',
			'metro_id' => 'Metro',
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
		$criteria->compare('maps_id',$this->maps_id);
		$criteria->compare('metro_id',$this->metro_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}