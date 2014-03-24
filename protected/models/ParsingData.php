<?php

/**
 * Модель таблицы "parsing_data".
 *
 * У таблицы 'parsing_data' следующие поля:
 * @property string $id
 * @property string $status
 * @property string $x
 * @property string $y
 * @property string $address
 * @property string $categories
 * @property string $work
 * @property string $phones
 * @property string $name
 * @property string $filters
 * @property string $site
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
			array('address', 'checkAddress'),
			array('categories', 'checkCategories'),
			array('status', 'length', 'max'=>12),
			array('id', 'numerical'),
			array('x, y', 'numerical', 'min' => 50,'max'=>60),
			array('name', 'length', 'max'=>128),
			array('site', 'length', 'max'=>128),
			array('id, status, x, y, address, categories, work, phones, name, site, filters', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array связи с другими моделями.
	 */
	public function relations() {
		return array(
		);
	}

    public function checkAddress($attribute,$params) {
        $map = $this->parseAddress();
        if (!$map->city_id) {
            $this->addError($attribute, 'Город не определился');
        } else  if ($map->city->id != Yii::app()->city->id && $map->city->parent_city_id != Yii::app()->city->id) {
            $this->addError($attribute, 'Неверный город: '.$map->city->title);
        }

        if ((!$map->street && !$map->building) || !$map->structure) {
            $items = array();
            foreach ($map->getAttributes() as $key => $value) {
                if ($value) {
                    $items[] = $key.'='.$value;
                }
            }
            $this->addError($attribute, 'Не удалось распарсить адрес:'.implode(', ', $items));
        }
    }

    public function checkCategories($attribute,$params) {
        $invalidCategories = array();
        foreach ($this->getFilters() as $title => $filter) {
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
     * @return FiltersMulty[]
     */
    public function getFilters() {
        $result = array();
        foreach (explode(',',$this->categories) as $title) {
            $result[$title] = Filters::model()->findBySql(
                 sprintf(
                     'SELECT * FROM filters
                     WHERE king="type"
                     and params like CONCAT("%%=",LOWER("%s"),"%%")',
                     $title
                 )
            );
        }
        return $result;
    }

    public function parse() {
        /** @var Mesto $mesto */
        $mesto = Mesto::model()->findByAttributes(array('title' => $this->name));
        if ($mesto) {
            if (!$mesto->site && $this->site) {
                $mesto->site = $this->site;
            }
            $mesto->save(false);
        } else {
            $mesto = new Mesto();
            $mesto->title = $this->name;
            $mesto->url = $mesto->convertUrlFromTitle();
            $mesto->site = $this->site;
            $mesto->avatar = 'none.png';
            $mesto->enabled = 1;
            $pages = array('main','proezd','comments');
            if ($this->work) {
                $pages[] = 'work';
            }
            $mesto->pages = implode(',',$pages);
            $mesto->save(false);
            $filters = $this->getFilters();
            foreach ($filters as $title => $filter) {
                if ($filter) {
                    $mestoFilter = new MestoFilters();
                    $mestoFilter->mesto_id = $mesto->id;
                    $mestoFilter->filter_id = $filter->id;
                    $params = array_map('strtolower', $filter->extractParams());
                    $mestoFilter->value = array_search($title, $params);
                    $mestoFilter->save(false);
                    $mestoCats = new MestoCats();
                    $mestoCats->mesto_id = $mesto->id;
                    $mestoCats->category_id = $filter->category_id;
                    $mestoCats->save(false);
                }
            }
        }
        $map = $this->parseAddress();
        $map->mesto_id = $mesto->id;
        if (!$map->findIdentical()) {
            $map->save(false);
            if ($this->work) {
                $json = json_decode($this->work, 1);
                $week = array(1 => 'Monday',2 => 'Tuesday',3 => 'Wednesday',4 => 'Thursday',
                    5 => 'Friday', 6 => 'Saturday',7 => 'Sunday');
                foreach ($json['Availabilities'] as $workParams) {
                    $fromParts = explode(':',$workParams['from']);
                    $toParts = explode(':',$workParams['to']);
                    $from = $fromParts[0]*60 + $fromParts[1];
                    $to = $toParts[0]*60 + $toParts[1];
                    if (isset($workParams['Everyday'])) {
                        $work = new Work();
                        $work->maps_id = $map->id;
                        $work->day_begin = 1;
                        $work->day_end = 7;
                        $work->time_begin = $from;
                        $work->time_end = $to;
                        $work->save(false);
                    } else {
                        foreach ($workParams['Intervals'] as $time) {
                            $work = null;
                            foreach ($week as $dayIndex => $day) {
                                if (!$work && isset($time[$day])) {
                                    $work = new Work();
                                    $work->maps_id = $map->id;
                                    $work->day_begin = $dayIndex;
                                } else if ($work && !isset($time[$day])) {
                                    $work->day_end = $dayIndex - 1;
                                    $work->time_begin = $from;
                                    $work->time_end = $to;
                                    $work->save(false);
                                }
                            }
                            if ($work) {
                                $work->day_end = 7;
                                $work->time_begin = $from;
                                $work->time_end = $to;
                                $work->save(false);
                            }
                        }
                    }
                }
            }
        }
        $this->status = 'applied';
        $this->save(false);
    }


    /**
     * @return Maps
     * @throws Exception
     */
    public function parseAddress() {
        $result = new Maps();
        $isStreet = false;
        foreach (explode(',',$this->address) as $address) {
            $address = ' '.trim($address).' ';
            if (strpos($address,'Республика')!==false) {
                continue;
            }
            if (strpos($address,' р-н')!==false) {
                continue;
            }
            if (trim($address) == Yii::app()->city->title ||
                strpos($address,' г. ')!==false ||
                strpos($address,' пос. ')!==false
            ) {
                $cityName = trim(str_replace(array(' г. ',' пос. '), '', $address));
                /** @var City $city */
                $city = City::model()->findByAttributes(array('title' => $cityName));
                if (!$city) {
                    throw new Exception('City '.$cityName.' not found');
                }
                $result->city_id = $city->id;
                continue;
            }
            $buildings = array('стр.','стр ','строение');
            foreach ($buildings as $building) {
                if (strpos($address, ' '.$building)) {
                    $result->building = trim(str_replace($building,'',$address),' .');
                    continue;
                }
            }
            $structures = array(
                'Улица' => array('ул'),
                'Переулок' => array('пер'),
                'Бульвар' => array('бул'),
                'Площадь' => array(),
                'Проспект' => array('просп',''),
                'Проезд' => array(),
                'Тупик' => array(),
                'Шоссе' => array(),
                'Набережная' => array(),
                'Вал' => array(),
                'Парк' => array(),
                'Тракт' => array(),
                'Комплекс' => array()
            );
            foreach ($structures as $structure => $texts) {
                $texts[] = mb_strtolower($structure, 'UTF-8');
                $lowerAddress = mb_strtolower($address,'UTF-8');
                foreach ($texts as $text) {
                    if (strpos($lowerAddress, ' '.$text.' ')!== false ||
                        strpos($lowerAddress, ' '.$text.'.')!== false
                    ) {
                        $result->structure = $structure;
                        if ($text == 'комплекс') {
                            $result->street = trim($address,' .');
                        } else {
                            $result->adress = trim(str_ireplace(
                                array(' '.$text.' ',' '.$text.'.'),
                                '',
                                $address
                            ),' .');
                            $isStreet = true;
                        }

                        continue;
                    }
                }
            }
            if ($isStreet) {
                $result->street = trim($address,' .');
                $isStreet = false;
                continue;
            }
            $result->building = trim($address,' .');

        }
        return $result;
    }

	/**
	 * @return array название полей
	 */
	public function attributeLabels() {
		return array(
			'id' => 'Parsing Data',
			'status' => 'Status',
			'x' => 'X',
			'y' => 'Y',
			'address' => 'Address',
			'categories' => 'Categories',
			'work' => 'Work',
			'phones' => 'Phones',
			'name' => 'Name',
			'site' => 'site',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('x',$this->x,true);
		$criteria->compare('y',$this->y,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('categories',$this->categories,true);
		$criteria->compare('work',$this->work,true);
		$criteria->compare('phones',$this->phones,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('site',$this->site);
		$criteria->compare('filters',$this->filters,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('pageSize' => 100)
		));
	}
}