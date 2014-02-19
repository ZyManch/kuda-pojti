<?php

class MenuCategoryController extends Controller {

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
		$model = new MenuCategory;
		$this->setPageTitle('');
		$this->initAdminMenu();

		if (isset($_POST['MenuCategory'])) {
			$model->attributes=$_POST['MenuCategory'];
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

		if (isset($_POST['MenuCategory'])) {
			$model->attributes = $_POST['MenuCategory'];
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model' => $model,
		));
	}

	/**
	 * Удаление модели.
	 * @param integer $id ID или Url модели
	 */
	public function actionDelete($id) {
		$this->initAdminMenu($model);
		if (Yii::app()->request->isPostRequest) {
			$this->loadModel($id)->delete();
			if(!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Неверный формат запроса удаления страницы.');
		}
	}

	/**
	 * Екшен списка моделей.
	 */
	public function actionIndex() {
		$this->setPageTitle('');
		$this->initAdminMenu();
		$dataProvider = new CActiveDataProvider('MenuCategory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Администрирование.
	 */
	public function actionAdmin() {
		$model=new MenuCategory('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['MenuCategory'])) {
			$model->attributes=$_GET['MenuCategory'];
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
