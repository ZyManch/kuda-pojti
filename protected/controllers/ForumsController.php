<?php

class ForumsController extends Controller {

    public $layout='//layouts/columnEmpty';
    protected $model = 'Forums';

    public function accessRules() {
        $access = parent::accessRules();
        $access[0]['actions'][] = 'reply';
        return $access;
    }
	/**
	 * Екшен показа одной модели.
	 * @param string $id ID или URL модели
	 */
	public function actionView($id) {
		$model = $this->loadModel($id);
		$this->setPageTitle($model->title);
		$this->initAdminMenu($model);
        $this->includeCss('forum');
		$this->render('view', array(
			'model' => $model,
            'topics' => $model->getTopicProvider()
		));
	}

    /**
     *
     */
    public function actionReply($id) {
        $topic = new Topics();
        $forum = Forums::model()->findByPk($id);
        if($forum === null) {
            throw new CHttpException(404, 'Запрашиваемая страница не найдена');
        }
        $forumlist = $forum->forumCat;
        $this->includeCss('forum');

        $this->setPageTitle('Новое сообщение в ' . $forumlist->title, false);
        $this->initAdminMenu($forum);
        if (isset($_POST['Topics'])) {
            $topic->attributes=$_POST['Topics'];
            $topic->user_id = Yii::app()->user->getId();
            $topic->forum_id = $forum->id;
            if ($topic->save()) {
                $this->redirect(array('view','id'=>$forum->id));
            }
        }

        $this->render('reply',array(
            'topic' => $topic,
            'topics' => $forum->getTopicProvider(),
            'forum' => $forum
        ));
    }

	/**
	 * Екшен создания новой модели
	 */
	public function actionCreate($id) {
		$forum = new Forums();
        $topic = new Topics();
        $forumlist = ForumsCats::model()->findByPk($id);
        $this->includeCss('forum');
        if($forumlist===null) {
            throw new CHttpException(404, 'Запрашиваемая страница не найдена');
        }

        $this->setPageTitle('Новая тема в ' . $forumlist->title, false);
        $this->initAdminMenu($forum);
		if (isset($_POST['Forums']) && isset($_POST['Topics'])) {
            $topic->attributes=$_POST['Topics'];
            $topic->user_id = Yii::app()->user->getId();

            $forum->attributes=$_POST['Forums'];
            $forum->user_id = Yii::app()->user->getId();
            $forum->parent_id = $id;
            if ($forum->validate() && $topic->validate()) {
                $forum->save();
                $topic->forum_id = $forum->id;
                if($topic->save()) {
                    $this->redirect(array('view','id'=>$forum->id));
                }
            }
		}

		$this->render('create',array(
            'forumlist' => $forumlist,
			'forum'=>$forum,
            'topic'=>$topic
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
