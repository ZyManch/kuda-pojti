<?php
class FiltersMulty extends Filters {

	public function applyFilter(CDbCriteria &$condition, $values) {
	    foreach ($values as &$item) {
	        $item = Yii::app()->db->getPdoInstance()->quote($item);
	        unset($item);
	    }
		$condition->join.=sprintf(
			'
				INNER JOIN mesto_filters %1$s 
					ON %1$s.mesto_id = t.id
					AND %1$s.filter_id = %2$d
					AND %1$s.value IN (%3$s)
			',
			'mf'.self::$tableSuffix++,
			$this->id,
			implode(',', $values)
		);
	}
	
	public function getValue($get){
	    $items = parent::getValue($get);
	    if (!$items) {
	        return array();
	    }
	    return explode(',', $items);
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
	
	public function htmlInfo() {
		$result = array();
		$params = $this->extractParams($_GET);
		foreach ($this->mestoFilters as $mesto) {
			$result[] = $params[$mesto->value];
		}
		return implode(', ', $result);
	}
}