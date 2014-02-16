<?php

/**
 * Модель таблицы "work".
 *
 * У таблицы 'work' следующие поля:
 * @property integer $id
 * @property integer $maps_id
 * @property integer $day_begin
 * @property integer $day_end
 * @property string $time_begin
 * @property string $time_end
 */
class Work extends ActiveRecord {

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'work';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('maps_id, day_begin, day_end, time_begin, time_end', 'required'),
			array('maps_id, day_begin, day_end', 'numerical', 'integerOnly'=>true),
			array('id, maps_id, day_begin, day_end, time_begin, time_end', 'safe', 'on'=>'search'),
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
			'day_begin' => 'Day Begin',
			'day_end' => 'Day End',
			'time_begin' => 'Time Begin',
			'time_end' => 'Time End',
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
		$criteria->compare('day_begin',$this->day_begin);
		$criteria->compare('day_end',$this->day_end);
		$criteria->compare('time_begin',$this->time_begin,true);
		$criteria->compare('time_end',$this->time_end,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getDayVariants() {
        return array(
            1 => 'Понедельник',
            2 => 'Вторник',
            3 => 'Среда',
            4 => 'Четверг',
            5 => 'Пятница',
            6 => 'Суббота',
            7 => 'Воскресенье',
        );
    }
}