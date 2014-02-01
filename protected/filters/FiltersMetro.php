<?php
class FiltersMetro extends Filters {
	public function applyFilter(CDbCriteria &$condition, $value) {
	    $crit = new CDbCriteria();
	    $crit->condition = 'title LIKE :title';
	    $crit->params['title'] = '%' . $value . '%';
	    $metros = Metro::model()->findAll($crit);
	    $ids = array();
	    foreach ($metros as $metro) {
	        $ids[] = $metro->id;
	    }
	    if (!$ids) {
	        $ids[] = 0;
	    }
		$condition->join.=sprintf(
			'
		        INNER JOIN maps %1$s
		            ON  %1$s.mesto_id= t.id
				INNER JOIN maps_metro %2$s
					ON %2$s.maps_id = %1$s.id
					AND %2$s.metro_id IN (%3$s)
			',
			'mf'.self::$tableSuffix++,
	        'mf'.self::$tableSuffix++,
			implode(',', $ids)
		);
	}
	
	public function extractParams($get = array()) {
	    return $this->params;
	}
	
	public function htmlInfo() {
	    if ($this->mestoFilters) {
	        $mestoId = $this->mestoFilters[0]->mesto_id;
	        $maps = Maps::model()->with('metro')->findAllByAttributes(array('mesto_id' => $mestoId));
	        $result = array();
	        foreach ($maps as $map) {
	            if (!is_null($map->metro)) {
    	            foreach ($map->metro as $metro) {
        	            if (!isset($result[$metro->title])) {
        	                $result[$metro->title] = $metro;
        	            }
    	            }
	            }
	        }
	        return implode(', ', array_keys($result));
	    }
	    return 'отсутствует';
	}
}