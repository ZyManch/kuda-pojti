<?php

class CategoriesController extends Controller
{
	protected $model = 'Categories';


    public function initAdminMenu($model = null) {
        parent::initAdminMenu($model);
        if ($model) {
            $this->adminMenu['mesto'] = array('label' => 'Добавить место', 'url' => array('mesto/create','category_id' => $model->id),'image' => 'add');
        }
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
			if($model->save()) {
                $filter = new Filters();
                $filter->category_id = $model->id;
                $filter->type = 'Multy';
                $filter->key = 'type';
                $filter->king = 'type';
                $filter->title = 'Тип заведения';
                if (!$filter->save()) {
                    $message = array();
                    foreach ($filter->getErrors() as $key => $errors)  {
                        $message[] = $key.':'.implode('; ', $errors);
                    }
                    throw new Exception('Cant save main filter, error in '.implode('.', $message));
                }
				$this->redirect(array('view','id'=>$model->url));
            }
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
		$this->initAdminMenu($model);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Categories']))
		{
			$model->attributes=$_POST['Categories'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->url));
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


}
