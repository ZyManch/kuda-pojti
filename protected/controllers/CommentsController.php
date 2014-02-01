<?php

class CommentsController extends Controller {

    public $model = 'Forums';
    
    public function accessRules() {
        return array_merge(
    	    array(array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions' => array('mesto'),
			),),
            parent::accessRules()
    	);
    }
	/**
	 * Екшен показа одной модели.
	 * @param string $id ID или URL модели
	 */
	public function actionView($id) {
		$model = $this->loadModel($id);
        $forum = $model->getCommentForum();
		$this->setPageTitle($model->title);
		$this->initAdminMenu($model);
		$this->render('view', array(
			'model' => $model,
            'topics' => $forum->getTopicProvider()
		));
	}
	
	public function actionMesto($id) {
	    $this->model = 'Mesto';
        $this->includeCss('comments');
	    $model = $this->loadModel($id);
        $forum = $model->getCommentForum();
        $topic = new Topics();
	    $this->setPageTitle($model->title, false);
	    $this->initPageMenu($model);
	    $this->initAdminMenu($model);
        if (isset($_POST['Topics'])) {
            $topic->attributes=$_POST['Topics'];
            $topic->user_id = Yii::app()->user->getId();
            $topic->forum_id = $forum->id;
            if ($topic->save()) {
                $this->redirect(array('comments/mesto','id'=>$id));
            }
        }
	    $this->render('mesto', array(
    		'model' => $model,
            'topic'  => $topic,
            'topics' => $forum->getTopicProvider(true)
	    ));
	}

	/**
	 * Екшен создания новой модели
	 */
	public function actionCreate() {
		$model = new Comments;
		$this->setPageTitle('');
		$this->initAdminMenu();

		if (isset($_POST['Comments'])) {
			$model->attributes=$_POST['Comments'];
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

		if (isset($_POST['Forums'])) {
			$model->attributes = $_POST['Forums'];
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
		$dataProvider = new CActiveDataProvider('Forums');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Администрирование.
	 */
	public function actionAdmin() {
		$model=new Forums('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Forums'])) {
			$model->attributes=$_GET['Forums'];
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
