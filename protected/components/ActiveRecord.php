<?php

/**
 * This integrface of the model class
 */
class ActiveRecord extends CActiveRecord {

    protected $dbName = 'db';

    public function getDbConnection() {
        $class = get_called_class();
        if(isset(self::$db[$class])) {
            return self::$db[$class];
        } else {
            self::$db[$class] = Yii::app()->{$this->dbName};
            if(self::$db[$class] instanceof CDbConnection) {
                return self::$db[$class];
            } else {
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
            }
        }
    }
	/**
	 * Returns the static model of the specified AR class.
	 * @return Categories the static model class
	 */
	public static function model($className=false)
	{
		if (!$className) {
			$className = get_called_class();
		}
		return parent::model($className);
	}
	
	/**
	 * Finds a single active record with the specified primary key.
	 * See {@link find()} for detailed explanation about $condition and $params.
	 * @param mixed $pk primary key value(s). Use array for multiple primary keys. For composite key, each key value must be an array (column name=>column value).
	 * @param mixed $condition query condition or criteria.
	 * @param array $params parameters to be bound to an SQL statement.
	 * @return CActiveRecord the record found. Null if none is found.
	 */
	public function findByPk($pk,$condition='',$params=array())
	{
		Yii::trace(get_class($this).'.findByPk()','system.db.ar.CActiveRecord');
		$scheme = $this->getTableSchema();
		if (isset($scheme->columns['url'])) {
		    return $this->findByAttributes(array('url' => $pk));
		}
		return parent::findByPk($pk, $condition, $params);
	}
    
	static function toUrl($str){
		$tr = array(
				'А'=>'a','Б'=>'b','В'=>'v','Г'=>'g',
				'Д'=>'d','Е'=>'e','Ж'=>'j','З'=>'z','И'=>'i',
				'Й'=>'y','К'=>'k','Л'=>'l','М'=>'m','Н'=>'n',
				'О'=>'o','П'=>'p','Р'=>'r','С'=>'s','Т'=>'t',
				'У'=>'u','Ф'=>'f','Х'=>'h','Ц'=>'ts','Ч'=>'ch',
				'Ш'=>'sh','Щ'=>'sch','Ъ'=>'','Ы'=>'yi','Ь'=>'',
				'Э'=>'e','Ю'=>'yu','Я'=>'ya','а'=>'a','б'=>'b',
				'в'=>'v','г'=>'g','д'=>'d','е'=>'e','ж'=>'j',
				'з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l',
				'м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r',
				'с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h',
				'ц'=>'ts','ч'=>'ch','ш'=>'sh','щ'=>'sch','ъ'=>'y',
				'ы'=>'yi','ь'=>'','э'=>'e','ю'=>'yu','я'=>'ya',
				' '=> '-', '.'=> '', '/'=> '-'
		);
		$url = strtr($str,$tr);
		return preg_replace('/[^A-Za-z0-9_\-]/', '', $url);
	}

}