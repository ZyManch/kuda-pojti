<?php

class FiltersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $model = 'Filters';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id = null)
	{
		$model=new Filters;
        $this->model = 'Categories';
        if ($id) {
            $categories = $this->loadModel($id);
            $model->category_id = $categories->id;
            $this->initAdminMenu($categories);
        } else {
            $this->initAdminMenu();
        }

        $attributes = $this->_getFilterParam($model);
        if ($attributes) {
            $model->attributes=$attributes;
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
	public function actionUpdate($id) {
        /** @var Filters $model */
		$model=$this->loadModel($id);
        $this->initAdminMenu($model);
        $attributes = $this->_getFilterParam($model);
		if ($attributes) {
			$model->attributes=$attributes;
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id = null)	{
        $this->model = 'Categories';
        if ($id) {
            $categories = $this->loadModel($id);
            $this->initAdminMenu($categories);
        } else {
            $this->initAdminMenu();
        }
		$dataProvider=new CActiveDataProvider('Filters');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    protected function _getFilterParam($model) {
        $modelClass = get_class($model);
        if (!isset($_POST[$modelClass]) || !is_array($_POST[$modelClass])) {
            return false;
        }
        $attributes = $_POST[$modelClass];
        $type = $attributes['type'];
        $params = $attributes['params'][$type];
        switch ($type) {
            case 'range':
                $attributes['params'] = implode("\n", array($params[0],$params[1],$params[2]));
                break;
            case 'list':
                $attributes['params'] = array();
                foreach ($params['keys'] as $index => $key) {
                    if ($key) {
                        $attributes['params'] = $key.'='.$params['values'][$index];
                    }
                }
                $attributes['params'] = implode("\n", $attributes['params']);
                break;
            default:
                $attributes['params'] = '';
        }
        return $attributes;
    }

    /**
     * @param Filters $model
     */
    public function _initAdminMenu($model = null) {
        $this->adminMenu = array();
        if (!is_null($model) && $model instanceof Categories) {
            $this->adminMenu['category'] = array('label'=>'Категория', 'url'=>array('categories/view','id' => $model->url),'image' => 'list');
            $this->adminMenu['create'] = array('label'=>'Добавить', 'url'=>array('create', 'id' => $model->url ),'image' => 'add');
        } else {
            $this->adminMenu['create'] = array('label'=>'Добавить', 'url'=>array('create', 'id' => $model? $model->category->url : null),'image' => 'add');
        }
        if (!is_null($model) && $model instanceof Filters) {
            if ($model->category_id) {
                $this->adminMenu['category'] = array('label'=>'Категория', 'url'=>array('categories/view','id' => $model->category->url),'image' => 'list');
                $this->adminMenu['index'] = array('label'=>'Список', 'url'=>array('index','id' => $model->category_id),'image' => 'list');
            }
            $this->adminMenu['update'] = array('label'=>'Редактировать', 'url'=>array('update', 'id'=>$model->id),'image' => 'update');
            $this->adminMenu['delete'] = array('label'=>'Удалить', 'url'=>array('delete','id'=>$model->id),'image' => 'delete');
        }
    }


}
