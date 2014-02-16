<?php

class MestoController extends Controller
{
	protected $model = 'Mesto';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$this->initPageMenu($model);
		$this->setPageTitle($model->title, false);
		$this->initAdminMenu($model);
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($category_id = null)	{
		$model=new Mesto;
        if ($category_id) {
            $model->categories = array($category_id);
        }
        $model->pages = 'main,comments';

		if(isset($_POST['Mesto']))
		{
			if($this->_fillAndSaveModel($model))
				$this->redirect(array('view','id'=>$model->url));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mesto']))
		{
			if($this->_fillAndSaveModel($model))
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
		$dataProvider=new CActiveDataProvider('Mesto');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


    protected function _fillAndSaveModel(Mesto $model) {
        $attributes = $_POST['Mesto'];
        $attributes['pages'] = isset($_POST['pages']) ? implode(',',$_POST['pages']) : 'main';
        if ($model->getIsNewRecord()) {
            $attributes['avatar'] = 'none.png';
        } else {
            $attributes['avatar'] = $model->id.'.jpg';
        }
        $model->attributes = $attributes;
        if (!$model->save()) {
            return false;
        }
        $avatar = CUploadedFile::getInstance($model,'avatar');
        if ($avatar) {
            $image = Yii::app()->image->load($avatar->getTempName());
            $image->resize(348,154, Image::AUTO_MAX);
            $image->crop(348,154);
            $image->save('images/mesto/'.Yii::app()->params['avatar'].'/'.$model->id.'.jpg');
            $model->avatar = $model->id.'.jpg';
            $model->save();
        }
        return true;
    }

}
