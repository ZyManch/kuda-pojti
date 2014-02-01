<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/columnContent';
	public $description='';
	protected $model;
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $adminMenu=array();
	
	public $pages = array();
	
	public function filters() {
		return array(
            'accessControl', // perform access control for CRUD operations
		);
	}
	
	/**
	 * Специальный .
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
		);
	}
	
	public function init() {
		$file = strtolower($this->getId());
        Yii::app()->clientScript->registerCoreScript('jquery');
		if (file_exists('css/'.$file.'.css')) {
			$this->includeCss($file);
		}
	}
	
	public function pageLabels(){
		return array(
			'main'		=> 'Информация',
			'gallery'	=> 'Фотографии',
			'discont'	=> 'Скидки',
			'afisha'	=> 'Расписание',
			'proezd'	=> 'Проезд',
			'menu'		=> 'Меню',
	        'work'		=> 'График работы',
			'comments'	=> 'Комментарии'
		);
	}
	
	public function initPageMenu(Mesto $model) {
		$this->layout = '//layouts/columnPages';
		$labels = $this->pageLabels();
		$pages = explode(',', $model->pages);
		$controller = $this->getId();
		$action = $this->getAction();
		$finded = false;
		foreach ($pages as $page) {
			$label = $page;
			if ($labels[$page]) {
				$label = $labels[$page];
			}
			$url = 'mesto/view';
			if ($page != 'main') {
				$url = $page . '/mesto';
			}
			if ($url == $this->getRoute()) {
				$finded = true;
				$url = array();
			} else {
			    $url = array(
			        $url,
			        'id' => $model->url      
	            );
			}
			$this->pages[$page] = array(
				'label' => $label, 
				'url'   => $url
			); 
		}
		if (!$finded) {
			throw new CHttpException(404,'Запрашиваемая страница не найдена');
		}
	}

    public function initMessageMenu() {
        $this->layout = '//layouts/columnMessage';
    }
	
	public function initAdminMenu($model = null) {
		if(Yii::app()->user->checkAccess('root')) {
			$this->adminMenu = array();
			$this->adminMenu[] = array('label'=>'Список', 'url'=>array('index'));
			$this->adminMenu[] = array('label'=>'Добавить', 'url'=>array('create'));
			if (!is_null($model)) {
				$this->adminMenu[] = array('label'=>'Просмотр', 'url'=>array('view', 'id'=>$model->url));
				$this->adminMenu[] = array('label'=>'Редактировать', 'url'=>array('update', 'id'=>$model->url));
				$this->adminMenu[] = array('label'=>'Удалить', 'url'=>array('delete','id'=>$model->url));
			}
			$this->adminMenu[] = array('label'=>'Администрирование', 'url'=>array('admin'));
		}
	}
	
	public function setPageTitle($title, $withPrefix = true) {
		if ($withPrefix) {
			parent::setPageTitle($title . ' на Куда Пойти');
		} else {
			parent::setPageTitle($title);
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id, $with = array()){
		$model = $this->model;
		$model=call_user_func(array($model, 'model'))->with($with)->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Запрашиваемая страница не найдена');
		if (isset($model->description)) {
			$this->description = $model->description;
		}
		return $model;
	}
	
	
	protected function includeCss($fileName) {
		$file = 'css/'.$fileName.'.css';
		Yii::app()->clientScript->registerCssFile($file);
	}
	
	protected function includeJs($fileName) {
		$file = 'js/'.$fileName.'.js';
		Yii::app()->clientScript->registerScriptFile($file);
	}

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $this->includeCss('deleter');
        $this->setPageTitle('Подтвердите удаление', false);
        $deleter = $this->createWidget('ext.deleter.deleter', array(
            'model' => $model
        ));
        $this->render('ext.deleter.views.delete', array(
            'deleter' => $deleter
        ));
    }
}