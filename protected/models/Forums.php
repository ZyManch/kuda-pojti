<?php

/**
 * Модель таблицы "forums".
 *
 * У таблицы 'forums' следующие поля:
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $content
 * @property integer $user_id
 * @property integer $topic_count
 * @property string $changed
 * @property integer $last_user_id
 * @property ForumsCats $forumCat
 * @property Topics $topics
 */
class Forums extends ActiveRecord {

    protected $dbName = 'forumdb';

    const TOPICS_IN_PAGE = 30;
	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'forums';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('title, user_id', 'required'),
			array('parent_id, user_id, topic_count, last_user_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>128),
			array('id, parent_id, title, user_id, topic_count, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array связи с другими моделями.
	 */
	public function relations() {
		return array(
            'forumCat' => array(self::BELONGS_TO, 'ForumsCats', 'parent_id'),
            'lastUser' => array(self::BELONGS_TO, 'Users', 'last_user_id'),
            'topics' => array(self::HAS_MANY, 'Topics', 'forum_id')
		);
	}

    public function beforeSave() {
        $this->title = htmlspecialchars($this->title);
        if ($this->isNewRecord) {
            $this->last_user_id = $this->user_id;
            $forumCat = $this->forumCat;
            $forumCat->last_user_id = $this->last_user_id;
            $forumCat->forum_count++;
            $forumCat->save();
        }
        return true;
    }

    public function beforeDelete() {
        $forumCat = $this->forumCat;
        $forumCat->forum_count--;
        $forumCat->save();
        return true;
    }


    public function getTopicProvider($invert = false) {
        return new CActiveDataProvider('Topics', array(
            'criteria' => array(
                'with' => array('autor'),
                'condition' => 't.forum_id=:parent',
                'params' => array('parent'=>$this->id)
            ),
            'pagination'=>array(
                'pageSize' => self::TOPICS_IN_PAGE,
            ),
            'sort' => array(
                'defaultOrder' => 't.changed ' . ($invert ? 'DESC' : 'ASC'),
            )
        ));
    }

	/**
	 * @return array название полей
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'parent_id' => 'Раздел',
			'title' => 'Название темы',
			'user_id' => 'Автор',
			'topic_count' => 'Количество собщений',
            'last_user_id' => 'Последний пост',
			'changed' => 'Последнее изменение',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('topic_count',$this->topic_count);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}