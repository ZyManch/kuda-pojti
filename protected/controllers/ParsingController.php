<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.03.14
 * Time: 9:28
 */
class ParsingController extends Controller {

    public $model = 'ParsingData';
    public $defaultAction = 'admin';

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('script','download'),
                'users' => array('*')
            ),
            array('allow',
                'actions'=>array('download','admin','userscript','script','view',
                    'delete','create','update'),
                'roles'=>array('moderator'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionScript() {
        /** @var CLogRouter $log */
        header('Content-Type: application/x-javascript');
        $log = Yii::app()->log;
        $routes = $log->getRoutes();
        if ($routes && isset($routes[0]) && $routes[0] instanceof XWebDebugRouter) {
            $routes[0]->allowedIPs = array();
        }
        return $this->renderPartial('script');
    }

    public function actionUserscript() {
        $this->initAdminMenu();
        return $this->render('userscript');
    }

    public function actionDownload($items) {
        $items = json_decode($items, 1);
        foreach ($items as $item) {
            $parsing = ParsingData::model()->
                findByAttributes(array('name' => $item['properties']['name']));
            if ($parsing) {
                continue;
            }
            $parsing = new ParsingData();

        }
    }

    /**
     * Екшен показа одной модели.
     * @param string $id ID или URL модели
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        $this->setPageTitle($model->title);
        $this->initAdminMenu($model);
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Екшен создания новой модели
     */
    public function actionCreate() {
        $model = new ParsingData;
        $this->setPageTitle('');
        $this->initAdminMenu();

        if (isset($_POST['ParsingData'])) {
            $model->attributes=$_POST['ParsingData'];
            if($model->save()) {
                $this->redirect(array('view','id'=>$model->parsing_data_id));
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

        if (isset($_POST['ParsingData'])) {
            $model->attributes = $_POST['ParsingData'];
            if($model->save()) {
                $this->redirect(array('view','id'=>$model->parsing_data_id));
            }
        }

        $this->render('update',array(
            'model' => $model,
        ));
    }

    /**
     * Удаление модели.
     * @param integer $id ID или Url модели
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $this->initAdminMenu($model);
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel($id)->delete();
            if(!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400,'Неверный формат запроса удаления страницы.');
        }
    }


    /**
     * Администрирование.
     */
    public function actionAdmin() {
        $model=new ParsingData('search');
        $this->initAdminMenu();
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ParsingData'])) {
            $model->attributes=$_GET['ParsingData'];
        }
        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    public function _initAdminMenu($model = null) {
        $this->adminMenu = array();
        $this->adminMenu['userscript'] = array('label'=>'Юзерскрипт', 'url'=>array('userscript'),'image' => 'view');
        $this->adminMenu['script'] = array('label'=>'Скрипт', 'url'=>array('script'),'image' => 'view');
        $this->adminMenu['create'] = array('label'=>'Добавить', 'url'=>array('create'),'image' => 'add');
        $this->adminMenu['admin'] = array('label'=>'Список', 'url'=>array('admin'),'image' => 'list');
        if (!is_null($model)) {
            $this->adminMenu['view'] = array('label'=>'Просмотр', 'url'=>array('view', 'id'=>$model->url),'image' => 'view');
            $this->adminMenu['update'] = array('label'=>'Редактировать', 'url'=>array('update', 'id'=>$model->url),'image' => 'update');
            $this->adminMenu['delete'] = array('label'=>'Удалить', 'url'=>array('delete','id'=>$model->url),'image' => 'delete');
            $this->adminMenu['mesto'] = array('label' => 'Добавить место', 'url' => array('mesto/create','category_id' => $model->id),'image' => 'add');
            $this->adminMenu['filters'] = array('label' => 'Фильтры', 'url' => array('filters/index','id' => $model->url),'image' => 'list');
        }
    }


}