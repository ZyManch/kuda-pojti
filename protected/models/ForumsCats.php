<?php

/**
 * Модель таблицы "forums_cats".
 *
 * У таблицы 'forums_cats' следующие поля:
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property integer $position
 */
class ForumsCats extends ActiveRecord {

    protected $dbName = 'forumdb';

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'forums_cats';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('title, position', 'required'),
			array('parent_id, position, forum_count, topic_count, last_user_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>128),
            array('avatar', 'length', 'max'=>64),
            array('visible', 'length', 'max'=>3),
			array('id, title, parent_id, position, avatar', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array связи с другими моделями.
	 */
	public function relations() {
		return array(
            'childs' => array(self::HAS_MANY, 'ForumsCats', 'parent_id'),
            'forums' => array(self::HAS_MANY, 'Forums', 'parent_id'),
            'lastUser' => array(self::BELONGS_TO, 'Users', 'last_user_id')
		);
	}

	/**
	 * @return array название полей
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'parent_id' => 'Parent',
            'forum_count' => 'Тем',
            'topic_count' => 'Сообщений',
            'last_user_id' => 'Последнее сообщение'
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}