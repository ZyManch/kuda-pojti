<?php

class ForumlistController extends Controller {

    const FORUMS_IN_PAGE = 30;
    public $layout='//layouts/columnEmpty';
    protected $model = 'ForumsCats';
	/**
	 * Екшен показа одной модели.
	 * @param string $id ID или URL модели
	 */
	public function actionView($id) {
		$model = $this->loadModel($id);
        $this->includeCss('forum');
        $provider = new CActiveDataProvider('Forums', array(
            'criteria' => array(
                'with' => array('lastUser'),
                'condition' => 't.parent_id=:parent',
                'params' => array('parent'=>$model->id)
            ),
            'pagination'=>array(
                'pageSize'=> self::FORUMS_IN_PAGE,
            ),
            'sort' => array(
                'defaultOrder' => 't.changed DESC',
            )
        ));
		$this->setPageTitle($model->title);
		$this->initAdminMenu($model);
		$this->render('view', array(
			'model' => $model,
            'provider' => $provider
		));
	}

	/**
	 * Екшен создания новой модели
	 */
	public function actionCreate() {
		$model = new ForumsCats;
		$this->setPageTitle('');
		$this->initAdminMenu();

		if (isset($_POST['ForumsCats'])) {
			$model->attributes=$_POST['ForumsCats'];
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

		if (isset($_POST['ForumsCats'])) {
			$model->attributes = $_POST['ForumsCats'];
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
        set_time_limit(5);
		$this->setPageTitle('Форум');
        $this->includeCss('forum');
		$this->initAdminMenu();
        $condition = new CDbCriteria();
        $condition->addCondition('t.parent_id IS NULL');
        $condition->order = 't.position ASC';
        $forums = ForumsCats::model()->with('childs','lastUser')->findAll($condition);
		$this->render('index', array(
			'forums' => $forums
		));
	}

	/**
	 * Администрирование.
	 */
	public function actionAdmin() {
		$model=new ForumsCats('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['ForumsCats'])) {
			$model->attributes=$_GET['ForumsCats'];
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
