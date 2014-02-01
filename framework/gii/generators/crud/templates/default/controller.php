<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass; ?> {

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
		$model = new <?php echo $this->modelClass; ?>;
		$this->setPageTitle('');
		$this->initAdminMenu();

		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save()) {
				$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
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

		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->attributes = $_POST['<?php echo $this->modelClass; ?>'];
			if($model->save()) {
				$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
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
		$dataProvider = new CActiveDataProvider('<?php echo $this->modelClass; ?>');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Администрирование.
	 */
	public function actionAdmin() {
		$model=new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['<?php echo $this->modelClass; ?>'])) {
			$model->attributes=$_GET['<?php echo $this->modelClass; ?>'];
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
