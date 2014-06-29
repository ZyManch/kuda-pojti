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
			array('filters', 'checkFilters'),
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

    public function checkFilters($attribute,$params) {
        foreach ($this->getFilters() as $name => $filterParam) {
            $values = $filterParam['value'];
            /** @var Filters $filter */
            $filter = $filterParam['filter'];
            if ($filter->getIsNewRecord()) {
                $skipped = FiltersSkiped::model()->findByAttributes(array('key'=>$name));
                if (!$skipped) {
                    /** @var FiltersMulty $categoryFilter */
                    $categoryFilters = array_filter($this->getCategoryFilters());
                    $categoryFilter = array_shift($categoryFilters);
                    $this->addError(
                        $attribute,
                        'Фильтр "'.CHtml::link(
                            $filter->title,
                            array(
                                'filters/create',
                                'id' => $categoryFilter->category->url,
                                'title'=>$filter->title,
                                'key' => $filter->key,
                                'type' => $filter->type,
                                'value' => is_array($values) ? implode(';',$values) : $values,
                                'back' => str_replace('/','_', Yii::app()->request->requestUri)
                            )
                        ).'" не найден '.
                        '['.CHtml::link('пропустить',array('skip','filter' => $name)).']'
                    );
                }
                continue;
            }
            $values = $filterParam['value'];
            if ($filter instanceof FiltersMulty) {
                $validValues = $filter->extractParams();
                if (!is_array($values)) {
                    $values = array($values);
                }
                foreach ($values as $value) {
                    if (!in_array($value,$validValues)) {
                        $this->addError(
                             $attribute,
                             'Значение фильтра "'.$value.'" не поддержено в фильтре Multy '.$filter->id
                        );
                    }
                }
            } else if($filter instanceof FiltersBool) {
                if (!in_array($values, array(true,false),1)) {
                    $this->addError(
                         $attribute,
                         'Значение фильтра '.var_export($values,1).' не поддержано в фильтре Bool '.$filter->id
                    );
                }
            } else if($filter instanceof FiltersMetro) {
                $this->addError(
                     $attribute,
                     'Фильтр Metro не поддерживается'
                );
            } else if($filter instanceof FiltersRadio) {

            } else if($filter instanceof FiltersRangeIn) {
                foreach (is_array($values) ? $values : array($values) as $value) {
                    if (!strpos($value,'-') && !strpos($value,'–')) {
                        $this->addError(
                             $attribute,
                             'Фильтр RangeIn не поддерживается'
                        );
                    }
                }
            } else if($filter instanceof FiltersRangeOut) {
                $this->addError(
                     $attribute,
                     'Фильтр RangeIn не поддерживается'
                );
            } else if($filter instanceof FiltersWork) {
                $this->addError(
                     $attribute,
                     'Фильтр Work не поддерживается'
                );
            } else {
                $this->addError(
                     $attribute,
                     'Неизвестный класс фильтра :'.get_class($filter)
                );
            }
        }
    }

    public function getFilters() {
        if (!$this->filters) {
            return array();
        }
        $json = json_decode($this->filters,1);
        $result = array();
        foreach ($json as $filterParam) {
            $filter = Filters::model()->findByAttributes(array(
                'key' => $filterParam['id']
            ));
            $values = isset($filterParam['value']) ?
                $filterParam['value'] : $filterParam['values'];
            if (!$filter) {
                $firstValue = is_array($values) ? reset($values) : $values;
                switch ($filterParam['type']) {
                    case 'enum':
                        if (mb_strpos($firstValue,'-')!=false || mb_strpos($firstValue,'–')!=false) {
                            $filter = new FiltersRangeOut();
                            $filter->type = 'RangeIn';
                        } else {
                            $filter = new FiltersMulty();
                            $filter->type = 'Multy';
                        }
                        break;
                    case 'text':
                        if (mb_strpos($firstValue,'-')!=false || mb_strpos($firstValue,'–')!=false) {
                            $filter = new FiltersRangeOut();
                            $filter->type = 'RangeIn';
                        } else {
                            $filter = new FiltersRadio();
                            $filter->type = 'Radio';
                        }
                        break;
                    case 'bool':
                        $filter = new FiltersBool();
                        $filter->type = 'Bool';
                        break;
                    default:
                        $filter = new Filters();
                        if (mb_strpos($firstValue,'-')!=false || mb_strpos($firstValue,'–')!=false) {
                            $filter->type = 'RangeIn';
                        } else if (isset($filterParam['values'])) {
                            $filter->type = 'Multy';
                        } else {
                            if ($values === true) {
                                $filter->type = 'Bool';
                            } else {
                                $filter->type = 'Radio';
                            }
                        }
                }

                $filter->key = $filterParam['id'];
                $filter->title = $filterParam['name'];
            }
            $result[$filterParam['id']] = array(
                'filter' => $filter,
                'value' => $values
            );
        }
        return $result;
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
        foreach ($this->getCategoryFilters() as $title => $filter) {
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
    public function getCategoryFilters() {
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
            $filters = $this->getCategoryFilters();
            foreach ($filters as $title => $filter) {
                if ($filter) {
                    $mestoFilter = new MestoFilters();
                    $mestoFilter->mesto_id = $mesto->id;
                    $mestoFilter->filter_id = $filter->id;

                    $params = array_map(
                        function($field) {
                            return mb_strtolower($field,'UTF-8');
                        },
                        $filter->extractParams()
                    );
                    $mestoFilter->value = array_search(mb_strtolower($title,'UTF-8'), $params);
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
                    $days  = array();
                    if (isset($workParams['Everyday'])) {
                        $days[] = array(1,7);
                    } else {
                        $dayBegin = null;
                        foreach ($week as $dayIndex => $day) {
                            if (!$dayBegin && isset($workParams[$day]) && $workParams[$day]) {
                                $dayBegin = $dayIndex;
                            } else if ($dayBegin && (!isset($workParams[$day]) || !$workParams[$day])) {
                                $days[] = array($dayBegin, $dayIndex-1);
                                $dayBegin = null;
                            }
                        }
                        if ($dayBegin) {
                            $days[] = array($dayBegin, 7);
                        }
                    }
                    foreach ($workParams['Intervals'] as $time) {
                        $fromParts = explode(':',$time['from']);
                        $toParts = explode(':',$time['to']);
                        $from = $fromParts[0]*60 + $fromParts[1];
                        $to = $toParts[0]*60 + $toParts[1];
                        if ($to == 0) {
                            $to = 24 * 60;
                        } else if ($to < $from) {
                            foreach ($days as $interval) {
                                if ($interval[0] == 7) {
                                    $work = new Work();
                                    $work->maps_id = $map->id;
                                    $work->day_begin = $interval[0] + 1;
                                    $work->day_end = min(7,$interval[1] + 1);
                                    $work->time_begin = 0;
                                    $work->time_end = $to;
                                    $work->save(false);
                                }
                                if ($interval[1] == 7) {
                                    $work = new Work();
                                    $work->maps_id = $map->id;
                                    $work->day_begin = 1;
                                    $work->day_end = 1;
                                    $work->time_begin = 0;
                                    $work->time_end = $to;
                                    $work->save(false);
                                }
                            }
                            $to = 24 * 60;
                        }
                        foreach ($days as $interval) {
                            $work = new Work();
                            $work->maps_id = $map->id;
                            $work->day_begin = $interval[0];
                            $work->day_end = $interval[1];
                            $work->time_begin = $from;
                            $work->time_end = $to;
                            $work->save(false);
                            $work = null;
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
        $result->map_x = $this->x;
        $result->map_y = $this->y;
        $result->phones = preg_replace('#([^\+0-9,]+)#','',$this->phones);
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
            $isContinue = false;
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
                            $result->adress = trim(str_replace(
                                array(' '.$text.' ',' '.$text.'.'),
                                '',
                                $address
                            ),' .');
                            $isStreet = true;
                        }
                        $isContinue = true;
                        continue;
                    }
                }
            }
            if ($isContinue) {
                continue;
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