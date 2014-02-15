<?php

class MapsController extends Controller {

    public $model = 'Maps';
    

    public function actionMesto($id) {
        $this->model = 'Mesto';
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
		$model=$this->loadModel($id);
		$this->setPageTitle('Редактирование '.$model->title,false);
		$this->initAdminMenu();

		if (isset($_POST['Maps'])) {
			$model->attributes = $_POST['Maps'];
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
		$dataProvider = new CActiveDataProvider('Maps');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

}
