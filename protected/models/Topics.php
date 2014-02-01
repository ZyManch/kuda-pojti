<?php

/**
 * Модель таблицы "topics".
 *
 * У таблицы 'topics' следующие поля:
 * @property integer $id
 * @property string $content
 * @property string $content_html
 * @property integer $user_id
 * @property string $changed
 */
class Topics extends ActiveRecord {

    protected $dbName = 'forumdb';

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'topics';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('content, user_id', 'required'),
            array('content_html', 'length', 'max'=>65536),
			array('user_id, forum_id', 'numerical', 'integerOnly'=>true),
			array('id, content, content_html, user_id, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array связи с другими моделями.
	 */
	public function relations() {
		return array(
            'autor' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'forum' => array(self::BELONGS_TO, 'Forums', 'forum_id')
		);
	}

	/**
	 * @return array название полей
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'content' => 'Содержание',
			'user_id' => 'User',
			'changed' => 'Changed',
		);
	}

    public function beforeSave() {
        $this->content_html = nl2br(htmlspecialchars($this->content_html));
        if ($this->isNewRecord) {

            $forum = $this->forum;
            $forum->last_user_id = $this->user_id;
            $forum->topic_count++;
            $forum->save();

            $forumCat = $forum->forumCat();
            $forumCat->topic_count++;
            $forumCat->last_user_id = $this->user_id;
            $forumCat->save();
        }
        return true;
    }

    public function beforeDelete() {
        $forum = $this->forum;
        $forum->last_user_id = $this->user_id;
        $forum->topic_count--;
        $forum->save();

        $forumCat = $forum->forumCat();
        $forumCat->topic_count--;
        $forumCat->save();
        return true;
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
		$criteria->compare('content',$this->content,true);
		$criteria->compare('content_html',$this->content_html,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}