<?php
class FiltersRangeOut extends Filters{
	public function applyFilter(CDbCriteria &$condition, $value) {
		$condition->condition.='';
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