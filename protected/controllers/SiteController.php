<?php

class SiteController extends Controller
{
	
	public function filters() {
		return array();
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->setPageTitle('Кудай пойти в Москве',false);
		$dataProvider=new CActiveDataProvider('News');
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

    public function actionRegister() {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(CHtml::normalizeUrl('/site/profile'));
        }
        $model = new RegisterForm();
        $this->initMessageMenu();
        $this->setPageTitle('Регистрация', false);
        if(isset($_POST['ajax']) && $_POST['ajax']==='register-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if(isset($_POST['RegisterForm'])) {
            $model->attributes = $_POST['RegisterForm'];
            if($model->validate() && $model->register()) {
                if (Yii::app()->user->returnUrl) {
                    $this->redirect(Yii::app()->user->returnUrl);
                } else {
                    $this->redirect(CHtml::normalizeUrl('forumlist/index'));
                }
            }
        }
        $this->render('register', array('model' => $model));
    }

    public function actionProfile() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(CHtml::normalizeUrl('site/login'));
        }
        $model = Users::model()->findByPk(Yii::app()->user->getId());
        $this->setPageTitle('Ваш профиль', false);
        $this->render('profile', array(
            'model' => $model
        ));
    }

	/**
	 * Displays the login page
	 */
	public function actionLogin() {
        $this->initMessageMenu();
		$model=new LoginForm;
		$this->setPageTitle('Авторизация', false);
		if (isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			if($model->validate() && $model->login()) {
				$this->redirect(Yii::app()->user->returnUrl);
            }
		}
		$this->render('login', array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}