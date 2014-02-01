<?php
class FiltersRadio extends Filters {
    public function applyFilter(CDbCriteria &$condition, $value) {
	    $item = Yii::app()->db->getPdoInstance()->quote($value);
		$condition->join.=sprintf(
			'
				INNER JOIN mesto_filters %1$s 
					ON %1$s.mesto_id = t.id
					AND %1$s.filter_id = %2$d
					AND %1$s.value = %3$s
			',
			'mf'.self::$tableSuffix++,
			$this->id,
			$item
		);
	}
	
	public function extractParams($get = array()) {
		$data = explode("\n", $this->params);
		$result = array();
		foreach ($data as $str) {
			$str = explode('=', $str, 2);
			if (sizeof($str) == 2) {
				$result[$str[0]] = $str[1];
			}
		}
		return $result;
	}
}