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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Filters;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

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
	public function actionUpdate($id)
	{
        /** @var Filters $model */
		$model=$this->loadModel($id);

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
	public function actionIndex()
	{
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

}
