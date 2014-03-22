<?php

/**
 * Модель таблицы "parsing_data".
 *
 * У таблицы 'parsing_data' следующие поля:
 * @property string $parsing_data_id
 * @property string $status
 * @property string $x
 * @property string $y
 * @property string $address
 * @property string $categories
 * @property string $work
 * @property string $phones
 * @property string $name
 * @property integer $city
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
			array('x, y, address, categories, name', 'required'),
			array('address', 'checkCity'),
			array('categories', 'checkCategories'),
			array('status', 'length', 'max'=>12),
			array('x, y', 'numerical', 'min' => 50,'max'=>60),
			array('name', 'length', 'max'=>128),
			array('city', 'length', 'max'=>128),
			array('parsing_data_id, status, x, y, address, categories, work, phones, name, city, filters', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array связи с другими моделями.
	 */
	public function relations() {
		return array(
		);
	}

    public function checkCity($attribute,$params) {
        if (strpos($this->$attribute,Yii::app()->city->title)===false) {
            $this->addError($attribute, 'Другой город');
        }
    }

    public function checkCategories($attribute,$params) {
        $invalidCategories = array();
        foreach (explode(',',$this->$attribute) as $title) {
            $filter = Filters::model()->findBySql(
                 sprintf(
                     'SELECT * FROM filters WHERE king="type" and params like CONCAT("%%=",LOWER("%s"),"%%")',
                     $title
                 )
            );
            if (!$filter) {
                $invalidCategories[] = $title;
            }
        }
        if ($invalidCategories) {
            $links = array();
            foreach ($invalidCategories as $invalidCategory) {
                $links[] = CHtml::link($invalidCategory,array('filters/apply','title' => strtolower($invalidCategory),'back' => str_replace('/','_',Yii::app()->request->requestUri)));
            }
            $errors = 'Фильтр "'.implode(',',$invalidCategories).'" не найден. Добавить '.implode(', ', $links);
            $this->addError($attribute, $errors);
        }
    }

	/**
	 * @return array название полей
	 */
	public function attributeLabels() {
		return array(
			'parsing_data_id' => 'Parsing Data',
			'status' => 'Status',
			'x' => 'X',
			'y' => 'Y',
			'address' => 'Address',
			'categories' => 'Categories',
			'work' => 'Work',
			'phones' => 'Phones',
			'name' => 'Name',
			'city' => 'city',
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
		$criteria->compare('status',$this->status,true);
		$criteria->compare('x',$this->x,true);
		$criteria->compare('y',$this->y,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('categories',$this->categories,true);
		$criteria->compare('work',$this->work,true);
		$criteria->compare('phones',$this->phones,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('city',$this->city);
		$criteria->compare('filters',$this->filters,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('pageSize' => 100)
		));
	}
}