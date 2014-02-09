<?php

class AfishaController extends Controller {

    protected $model = 'Mesto';
    
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
    	return array(
    			array('allow',  
    					'actions'=>array('mesto'),
    					'users'=>array('*'),
    			),
    			array('deny',  // deny all users
    					'users'=>array('*'),
    			),
    	);
    }
	/**
	 * Екшен показа одной модели.
	 * @param string $id ID или URL модели
	 */
	public function actionMesto($id) {
		$model = $this->loadModel($id, array('images'));
		$this->setPageTitle($model->title, false);
		$this->initPageMenu($model);
		$this->initAdminMenu($model);
		$this->render('mesto', array(
			'model' => $model,
		));
	}

}
