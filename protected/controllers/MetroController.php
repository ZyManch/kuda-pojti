<?php

class MetroController extends Controller {

    public $model = 'Metro';
    
    
    public function accessRules() {
        $result = parent::accessRules();
        $result[0]['actions'][] = 'search';
        return $result;
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
		$model = new Metro;
		$this->setPageTitle('');
		$this->initAdminMenu();

		if (isset($_POST['Metro'])) {
			$model->attributes=$_POST['Metro'];
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

		if (isset($_POST['Metro'])) {
			$model->attributes = $_POST['Metro'];
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
		$dataProvider = new CActiveDataProvider('Metro');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	public function actionSearch($id) {
	    header('Content-Type: application/x-javascript');
	    $criteria = new CDbCriteria();
	    $criteria->addCondition('LOWER(title) LIKE :metro');
	    $criteria->params['metro'] = '%' . ($id) . '%';
	    $criteria->order = 'title ASC';
	    $metros = Metro::model()->findAll($criteria);
	    $result = array();
	    foreach ($metros as $metro) {
	        $result[$metro['id']] = $metro['title'];
	    }
	    print json_encode($result);
	    die();
	}
}
