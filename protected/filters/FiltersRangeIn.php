<?php
class FiltersRangeIn extends Filters{
    
	public function applyFilter(CDbCriteria &$condition, $value) {
		$condition->join.=sprintf(
			'
				INNER JOIN mesto_filters %1$s 
					ON %1$s.mesto_id = t.id
					AND %1$s.filter_id = %2$d
					AND %3$s BETWEEN %1$s.range_from AND %1$s.range_to 
			',
			'mf'.self::$tableSuffix++,
			$this->id,
			$value
		);
	}
	
	public function extractParams($get = array(), $width = 189) {
	    $valueArray = explode("\n", $this->params);
	    $result = array('min' => 0, 'max' => 100, 'text' => 'Выбрано %d');
	    foreach ($result as &$value) {
	    	$item = trim(array_shift($valueArray));
	    	if ($item) {
	    		$value = $item;
	    	}
	    	unset($value);
	    }
	    $result['log'] = pow($result['max'] + 1 - $result['min'], 1/$width);
	    return $result;
	}
}