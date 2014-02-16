<?php

/**
 * Модель таблицы "kudapojti_forum.city".
 *
 * У таблицы 'kudapojti_forum.city' следующие поля:
 * @property string $id
 * @property string $url
 * @property string $title
 * @property string $folder
 * @property string $has_metro
 * @property string $changed
 */
class City extends ActiveRecord {

    protected $dbName = 'forumdb';

    public $load;

	/**
	 * @return string имя таблицы
	 */
	public function tableName() {
		return 'city';
	}

    public function behaviors(){
        return array(
            'migration' => array(
                'class' => 'MigrationBehavior',
            ),
        );
    }

	/**
	 * @return array правила валидации полей.
	 */
	public function rules() {
		return array(
			array('url, title, folder, changed', 'required'),
			array('url, title, folder', 'length', 'max'=>32),
			array('has_metro', 'length', 'max'=>3),
			array('id, url, title, folder, has_metro, changed', 'safe', 'on'=>'search'),
		);
	}

    protected function instantiate($attributes) {
        if ($this->load) {
            $this->load = null;
            return $this;
        }
        return parent::instantiate($attributes);
    }

    public function init() {
        if ($this->load) {
            $result = $this->findByAttributes(array('folder' => $this->load));
            if (!$result) {
                throw new Exception('Неверная настройка города');
            }
        } else {
            parent::init();
        }
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
			'url' => 'Url',
			'title' => 'Title',
			'folder' => 'Folder',
			'has_metro' => 'Has Metro',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('folder',$this->folder,true);
		$criteria->compare('has_metro',$this->has_metro,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}