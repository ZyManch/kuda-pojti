<?php

/**
 * Модель таблицы "users".
 *
 * У таблицы 'users' следующие поля:
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $pass
 * @property string $type
 * @property string $token
 * @property int $ip
 * @property string $changed
 */
class Users extends ActiveRecord {

    protected $dbName = 'forumdb';

    const TYPE_USER = 'user';
    const TYPE_MODERATOR = 'moderator';
    const TYPE_ROOT = 'root';
    const TOKEN_EXPIRED = 31536000;

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'users';
	}

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('name, email, pass', 'required'),
			array('name, email, pass', 'length', 'max'=>32),
			array('type', 'length', 'max'=>9),
			array('id, name, email, pass, type, changed', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'email' => 'Email',
			'pass' => 'Pass',
			'type' => 'Type',
			'changed' => 'Changed',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function comparePassword($password) {
        return $this->pass == $this->getHashOfPassword($password);
    }

    public function getHashOfPassword($password) {
        return md5(Yii::app()->params['salt'].$password.$this->id);
    }
}