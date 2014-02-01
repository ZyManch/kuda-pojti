<?php
class FiltersBool extends Filters {
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
        return array();
    }
}