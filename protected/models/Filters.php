<?php

/**
 * This is the model class for table "filters".
 *
 * The followings are the available columns in table 'filters':
 * @property integer $id
 * @property string $title
 * @property string $help
 * @property string $type
 * @property string $params
 * @property integer $category_id
 * @property string $key
 * @property string $king
 * @property integer $position
 */
class Filters extends ActiveRecord
{
	static $tableSuffix = 1;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Filters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'filters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, key, king', 'required'),
			array('category_id, position', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>128),
			array('type', 'length', 'max'=>8),
			array('key', 'length', 'max'=>12),
			array('king', 'length', 'max'=>7),
			array('params, help', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, help, type, params, category_id, key, king, position', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		    'mestoFilters' => array(self::HAS_MANY, 'MestoFilters', 'filter_id', 'on' => 'mestoFilters.mesto_id = :mesto'),
		    'category' => array(self::BELONGS_TO, 'Categories', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'help' => 'Help',
			'type' => 'Type',
			'params' => 'Params',
			'category_id' => 'Category',
			'key' => 'Key',
			'king' => 'King',
			'position' => 'Position',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('help',$this->help,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('key',$this->key,true);
		$criteria->compare('king',$this->king,true);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function isEnabled($get){
	    return isset($get[$this->key]);
	}
	
	public function getValue($get){
	    if (isset($get[$this->key])) {
	        return $get[$this->key];
	    }
	    return null;
	}
	
	protected function instantiate($attributes)	{
		$class=get_class($this);
		$class.=$attributes['type'];
		$model=new $class(null);
		return $model;
	}
	
	public static function getListByCategory($categoryId) {
		return Filters::model()->findAllBySql(
			'
				SELECT *
				FROM filters
				WHERE ISNULL(category_id)
				OR category_id = :category
				ORDER BY position ASC
			',
			array(
				':category'=>$categoryId
			)
		);
	}
	
	public static function getListByMesto($mestoId) {
	    $crit = new CDbCriteria();
	    $crit->params['mesto'] = $mestoId;
	    $filters = Filters::model()->with('mestoFilters')->findAll($crit);
	    $result = array();
	    foreach ($filters as $filter) {
	        if (sizeof($filter->mestoFilters)) {
	            $result[] = $filter;
	        }
	    }
	    return $result;
	}
	
	public static function initFilterJs($filters, $get) {
	    $filterJs = array();
	    $configJs = array();
	    $selected = array();
	    foreach ($filters as $filter) {
	        $configJs[$filter->key] = $filter->extractParams($get);
	        $filterJs[$filter->key] = $filter->getValue($get);
	        $selected[$filter->key] = $filter->isEnabled($get);
	    }
	    Yii::app()->clientScript->registerScript('initFilters', '
	    	var filterConfig = {
	    		path: "' . Yii::app()->getBaseUrl(true) . CHtml::normalizeUrl(array('categories/view', 'id' => $_GET['id'])) . '",
	    		config: ' . json_encode($configJs) . ',
	            selected: ' . json_encode($selected) . ',
	            values: ' . json_encode($filterJs) . '
	        }
	    ', CClientScript::POS_HEAD);
	}
	
	public function htmlInfo() {
	    $result = array();
	    foreach ($this->mestoFilters as $mesto) {
	        $result[] = $mesto->value;
	    }
		return implode(', ', $result);
	}

    public function getTypeVariants() {
        return array(
            'Radio' => 'Переключатель "один из" (radio)',
            'Multy' => 'Список вариантов (milty)',
            'RangeIn' => 'Внутренний интервал (range in)',
            'RangeOut' => 'Внешний интервал (range out)',
            'Metro' => 'Метро (metro)',
            'Work' => 'Работа (work)',
            'Bool' => 'Наличие (bool)'
        );
    }

    public function getFormatsOfParam() {
        return array(
            'Radio' => 'list',
            'Multy' => 'list',
            'RangeIn' => 'range',
            'RangeOut' => 'range',
            'Metro' => 'empty',
            'Work' => 'empty',
            'Bool' => 'empty'
        );
    }

    public function getRangeAdminLabel() {
        return array(
            'from' => '',
            'to' => '',
            'text' => ''
        );
    }

    public function getFormatOfParam() {
        $list = $this->getFormatsOfParam();
        return $list[$this->type];
    }

    public function getKingVariants() {
        return array(
            'general' => 'Главный',
            'type' => 'Тип заведения',
            'medium' => 'Обычный',
            'lower' => 'Незначительный'
        );
    }
}