<?php

class WorkController extends Controller {

    public $model = 'Work';
    
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
	 * Екшен показа одной модели.
	 * @param string $id ID или URL модели
	 */
    public function actionMesto($id) {
	    $this->model = 'Mesto';
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
	 * Екшен создания новой модели
	 */
	public function actionCreate() {
		$model = new Work;
		$this->setPageTitle('');
		$this->initAdminMenu();

		if (isset($_POST['Work'])) {
			$model->attributes=$_POST['Work'];
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
		$this->setPageTitle('График работы '.$model->title,false);
		$this->initAdminMenu($model);

		if (isset($_POST['Work'])) {
			$model->attributes = $_POST['Work'];
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		$this->render('update',array(
			'model' => $model,
		));
	}

	/**
	 * Екшен списка моделей.
	 */
	public function actionIndex() {
		$this->setPageTitle('');
		$this->initAdminMenu();
		$dataProvider = new CActiveDataProvider('Work');
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
