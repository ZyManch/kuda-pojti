<?php

class MenuController extends Controller {

    protected $model = 'Mesto';


	public function actionMesto($id) {
		$model = $this->loadModel($id, array('images','menu.menuCategory'));
		$this->setPageTitle($model->title, false);
		$this->initPageMenu($model);
		$this->initAdminMenu($model);
        $this->includeCss('menu');
		$this->render('mesto', array(
			'model' => $model,
		));
	}

}
