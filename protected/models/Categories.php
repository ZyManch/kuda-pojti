<?php

/**
 * This is the model class for table "categories".
 *
 * The followings are the available columns in table 'categories':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $description
 * @property string $url
 * @property string $avatar
 * @property integer $position
 * @property integer $changed
 * @property Filters $typeFilter
 */
class Categories extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'categories';
	}

    public function behaviors(){
        return array(
            'migration' => array(
                'class' => 'MigrationBehavior',
            ),
        );
    }

    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, url, avatar', 'required'),
			array('position, changed', 'numerical', 'integerOnly'=>true),
			array('title, url', 'length', 'max'=>64),
			array('avatar', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, content, description, url, avatar, position, changed', 'safe', 'on'=>'search'),
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
			'typeFilter' => array(self::HAS_ONE, 'Filters', 'category_id', 'condition'=>'king="type"'),
		);
	}
	
	public function getTypeFilter() {
		$filter = $this->typeFilter;
		$params = explode("\n", $filter->params);
		$result = array();
		foreach ($params as $param) {
			$arr = explode('=', trim($param));
			if (sizeof($arr) == 2) {
				$result[$arr[0]] = $arr[1];
			}
		}
		return $result;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'description' => 'Description',
			'url' => 'Url',
			'avatar' => 'Avatar',
			'position' => 'Position',
			'changed' => 'Changed',
		);
	}

    public function getAvatarList() {
        $images = scandir('images/categories');
        $result = array();
        foreach (array_splice($images,2) as $image) {
            if (substr($image, -4) == '.png') {
                $result[$image] = $image;
            }
        }
        return $result;
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($with=array()) {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with = $with;
		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('changed',$this->changed);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}