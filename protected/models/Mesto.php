<?php

/**
 * This is the model class for table "mesto".
 *
 * The followings are the available columns in table 'mesto':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $url
 * @property string $avatar
 * @property string $email
 * @property string $pages
 * @property integer $enabled
 * @property string $description
 * @property integer $changed
 * @property Categories[] $categories
 * @property Maps[] $maps
 * @property Menu[] $menu
 */
class Mesto extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mesto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, pages, url', 'required'),
			array('enabled', 'numerical', 'integerOnly'=>true),
			array('title, url, email', 'length', 'max'=>64),
			array('changed, avatar', 'length', 'max'=>128),
			array('description, content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, content, url, avatar, email, pages, enabled, description, changed', 'safe', 'on'=>'search'),
		);
	}

    public function behaviors(){
        return array(
            'migration' => array(
                'class' => 'MigrationBehavior',
            ),
        );
    }

    public function convertUrlFromTitle() {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',

        );
        $url = preg_replace('~[^-a-zа-я0-9_]+~ui', '-', $this->title);
        return strtolower(str_replace(array_keys($converter),array_values($converter),$url));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'maps' => array(self::HAS_MANY, 'Maps', 'mesto_id'),
		    'images'=> array(self::HAS_MANY, 'Images', 'mesto_id'),
            'commentForum' => array(self::BELONGS_TO, 'Forums', 'forum_id'),
            'categories' => array(self::MANY_MANY, 'Categories', 'mesto_cats(mesto_id,category_id)','index' => 'id'),
            'menu' => array(self::HAS_MANY, 'Menu', 'mesto_id','with' => 'menuCategory','order' => 'menu_category_id DESC'),
		);
	}

    /**
     * @return Forums
     */
    public function getCommentForum(){
        $forum = $this->commentForum;
        if (is_null($forum)) {
            $forum = new Forums();
            $forum->title = $this->title;
            $forum->parent_id = Yii::app()->params['forum'];
            $forum->user_id = Yii::app()->user->getId();
            $forum->save();
            $this->forum_id = $forum->id;
            $this->save();
        }
        return $forum;
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
			'url' => 'Url',
			'avatar' => 'Avatar',
			'email' => 'Email',
			'pages' => 'Pages',
			'enabled' => 'Enabled',
			'description' => 'Description',
			'changed' => 'Changed',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search(){
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('pages',$this->pages,true);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('changed',$this->changed);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getFilterProvider($categoryId, $data){
		$filters = Filters::getListByCategory($categoryId);
		$criteria = new CDbCriteria();
		$criteria->with = array('maps.metro');
		$criteria->join='
			INNER JOIN mesto_cats mc 
				ON mc.mesto_id = t.id
				AND mc.category_id = '.$categoryId;
		foreach ($filters as $filter) {
			if (isset($data[$filter->key])) {
				$filter->applyFilter($criteria, $filter->getValue($data));
			}
		}
		return new CActiveDataProvider('Mesto',array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => 30
			)
		));
	}

    public function hasPage($page) {
        return in_array($page, explode(',',$this->pages));
    }

    public function getMenu() {
        $criteria = new CDbCriteria();
        $criteria->with = 'menu';
        $criteria->compare('menu.mesto_id',$this->id);
        return new CActiveDataProvider('MenuCategory', array(
            'criteria' => $criteria,
            'pagination' => false
        ));
    }

    public function getPagesList() {
        return array(
            'main' => 'Главная',
            'gallery' => 'Галлерея',
            'discont' => 'Скидки',
            'afisha' => 'Афиша',
            'proezd' => 'Проезд',
            'menu' => 'Меню',
            'work' => 'Время работы',
            'comments' => 'Комментарии'
        );
    }
}