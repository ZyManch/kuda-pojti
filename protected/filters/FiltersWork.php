<?php
class FiltersWork extends Filters {
    public function applyFilter(CDbCriteria &$condition, $value) {
		$condition->join.=sprintf(
			'
		        INNER JOIN maps %1$s
		            ON %1$s.mesto_id = t.id
				INNER JOIN work %2$s 
					ON  %2$s.maps_id = %1$s.id
					AND "%3$d" BETWEEN %2$s.day_begin  AND %2$s.day_end
		            AND "%3$d" BETWEEN %2$s.time_begin AND %2$s.time_end
			',
			'mf'.self::$tableSuffix++,
	        'mf'.self::$tableSuffix++,
			$value[0],
			$value[1]
		);
	}
	
	public function getValue($get){
		$items = parent::getValue($get);
		if (!$items) {
			return null;
		}
		$items = explode(',', $items);
		if (sizeof($items) == 2) {
		    return $items;
		}
		return array();
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
	    return false;
	}
}