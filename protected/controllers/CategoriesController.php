<?php

class CategoriesController extends Controller
{
	protected $model = 'Categories';

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'admin','delete'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)	{
		$model = $this->loadModel($id);
		$filters = Filters::getListByCategory($model->id);
		Filters::initFilterJs($filters, $_GET);
		$this->includeJs('filters');
		$this->includeCss('mesto');
		$this->setPageTitle($model->title);
		$this->initAdminMenu($model);
		$this->render('view',array(
			'model'        => $model,
			'dataProvider' => Mesto::getFilterProvider($model->id, $_GET),
		    'filters'      => $filters
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model=new Categories;
		$this->setPageTitle('Добавление категории');
		$this->initAdminMenu();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Categories']))
		{
			$model->attributes=$_POST['Categories'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$this->setPageTitle('Редактирование '.$model->title,false);
		$this->initAdminMenu();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Categories']))
		{
			$model->attributes=$_POST['Categories'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->setPageTitle('Категории');
		$this->initAdminMenu();
		$dataProvider=new CActiveDataProvider(
			'Categories',
			array(
				'criteria' => array(
					'with'=>array('typeFilter')
				),
				'pagination'=>array(
					'pageSize'=>20,
				),
			)
		);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Categories('search');
		$this->setPageTitle('Категории');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Categories']))
			$model->attributes=$_GET['Categories'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

}
