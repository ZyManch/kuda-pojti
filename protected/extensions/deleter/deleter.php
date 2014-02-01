<?php
class Deleter extends CWidget {

    public $model;

    protected function _relationList($model) {
        $className = get_class($model);
        $allRelations = $className::model()->relations();
        $needRelation = array();
        foreach ($allRelations as $key => $relation) {
            if ($relation[0] != CActiveRecord::BELONGS_TO) {
                $needRelation[$key] = $key;
            }
        }
        return $needRelation;
    }

    protected function _getTreeView($model) {
        $relations = $this->_relationList($model);
        foreach ($relations as $key => &$relation) {
            $list = $model->$key;
            if (is_null($list)) {
                $list = array();
            } else if (!is_array($list)) {
                $list = array($list);
            }
            $relation = array();
            foreach ($list as $item) {
                $relation[] = $this->_getTreeView($item);
            }
            unset($relation);
        }
        return array(
            'class'     => get_class($model),
            'relations' => $relations,
            'title'     => isset($model->title) ? $model->title :
                           (isset($model->name)  ? $model->name : '<без имени>')
        );
    }

    public function run() {
        $this->render('ext.deleter.views.tree', array(
            'tree'  => $this->_getTreeView($this->model)
        ));
    }
}