<?php

class ProezdController extends Controller {

    public $model = 'Maps';
    
    public function actionMesto($id) {
	    $this->model = 'Mesto';
	    $this->includeCss('proezd');
	    $model = $this->loadModel($id, array('maps.metro'));
	    $this->setPageTitle('Расположение '.$model->title, false);
	    $this->initPageMenu($model);
	    $this->initAdminMenu($model);
	    $this->render('mesto', array(
    		'model' => $model,
	        'maps'  => $model->maps
	    ));
	}
    
	/**
	 * Екшен показа одной модели.
	 * @param string $id ID или URL модели
	 */
	public function actionView($id) {
		$model = $this->loadModel($id);
		$this->setPageTitle($model->title);
		$this->initAdminMenu($model);
		$this->render('view', array(
			'model' => $model,
		));
	}

	/**
	 * Екшен создания новой модели
	 */
	public function actionCreate() {
		$model = new Maps;
		$this->setPageTitle('');
		$this->initAdminMenu();

		if (isset($_POST['Maps'])) {
			$model->attributes=$_POST['Maps'];
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Екшен редактирования модели
	 * @param integer $id ID или Url модели
	 */
	public function actionUpdate($id) {
        $this->model = 'Mesto';
		$model=$this->loadModel($id);
		$this->setPageTitle('Редактирование '.$model->title,false);
		$this->initAdminMenu($model);

        $map = new Maps();
        $map->mesto_id = $model->id;
        $map->city = Yii::app()->city->id;
		if (isset($_POST['Maps'])) {
            $map->attributes = $_POST['Maps'];
			if($map->save()) {
				$this->redirect(array('mesto','id'=>$model->url));
			}
		}

		$this->render('update',array(
			'model' => $model,
            'map' => $map
		));
	}

	/**
	 * Екшен списка моделей.
	 */
	public function actionIndex() {
		$this->setPageTitle('');
		$this->initAdminMenu();
		$dataProvider = new CActiveDataProvider('Maps');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
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
