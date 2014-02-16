<?php

class WorkController extends Controller {

    public $model = 'Mesto';

	/**
	 * Екшен показа одной модели.
	 * @param string $id ID или URL модели
	 */
    public function actionMesto($id) {
	    $this->includeCss('work');
	    $model = $this->loadModel($id,array('maps.work'));
	    $this->setPageTitle('График работы '.$model->title, false);
	    $this->initPageMenu($model);
	    $this->initAdminMenu($model);
	    $this->render('mesto', array(
    		'model' => $model,
	        'maps'  => $model->maps
	    ));
	}


	/**
	 * Екшен редактирования модели
	 * @param integer $id ID или Url модели
	 */
	public function actionUpdate($id) {
        /** @var Mesto $model */
		$model=$this->loadModel($id);
		$this->setPageTitle('График работы '.$model->title,false);
		$this->initAdminMenu($model);

        $newWorks = $this->_extractWorksFromPost();
		if (!is_null($newWorks)) {
            foreach ($model->maps as $map) {
                $oldWorks = $map->work;
                if (!isset($newWorks[$map->id])) {
                    foreach ($oldWorks as $workModel) {
                        $workModel->delete();
                    }
                } else {
                    foreach ($newWorks[$map->id] as $work) {
                        if (isset($work['id'])) {
                            $workModel = $oldWorks[$work['id']];
                            unset($oldWorks[$work['id']]);
                        } else {
                            $workModel = new Work();
                        }
                        $workModel->attributes = $work;
                        if (!$workModel->save()) {
                            throw new Exception('Ошибка сохранения времени работы');
                        }
                    }
                    foreach ($oldWorks as $workModel) {
                        $workModel->delete();
                    }
                }
            }
            $this->redirect(array('mesto','id'=>$model->url));
		}
		$this->render('update',array(
			'model' => $model,
		));
	}

    protected function _extractWorksFromPost() {
        if (!isset($_POST['Work'])) {
            return null;
        }
        $result = array();
        foreach ($_POST['Work'] as $work) {
            if (!$work['id']) {
                unset($work['id']);
            }
            $timeBegin = explode(':',$work['time_begin']);
            $timeEnd = explode(':',$work['time_end']);
            $work['time_begin'] = $timeBegin[0]*60 +$timeBegin[1];
            $work['time_end'] = $timeEnd[0]*60 +$timeEnd[1];
            $result[$work['maps_id']][] = $work;
        }
        return $result;
    }


    /**
     * @param Mesto $model
     */
    public function _initAdminMenu($model = null) {
        $this->adminMenu = array();
        if (!is_null($model)) {
            $this->adminMenu['mesto'] = array('label'=>'Просмотр', 'url'=>array('mesto', 'id'=>$model->url),'image' => 'view');
            $this->adminMenu['update'] = array('label'=>'Редактировать', 'url'=>array('update', 'id'=>$model->url),'image' => 'update');
        }
    }
}
