<?php

class WorkController extends Controller {

    public $model = 'Work';
    
    public function accessRules() {
    	return array_merge(
    			array(array('allow',  // allow all users to perform 'index' and 'view' actions
    					'actions' => array('mesto'),
    			),),
    			parent::accessRules()
    	);
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
		$model=$this->loadModel($id);
		$this->setPageTitle('Редактирование '.$model->title,false);
		$this->initAdminMenu();

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
	 * Администрирование.
	 */
	public function actionAdmin() {
		$model=new Work('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Work'])) {
			$model->attributes=$_GET['Work'];
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
