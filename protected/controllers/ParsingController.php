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
                'actions'=>array('download','admin','userscript','script',
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

    public function actionDownload() {
        $items = json_decode(Yii::app()->request->getParam('items'), 1);
        foreach ($items as $item) {
            $metadata = $item['properties']['CompanyMetaData'];
            $geometry = $item['geometry'];
            $parsing = ParsingData::model()->
                findByAttributes(array(
                    'name'    => $item['properties']['name'],
                    'address' => $metadata['address']
                ));
            if ($parsing) {
                continue;
            }
            $parsing = new ParsingData();
            $parsing->x = $geometry['coordinates'][0];
            $parsing->y = $geometry['coordinates'][1];
            $parsing->address = $metadata['address'];
            $parsing->status = 'obtained';
            $categories = array();
            if ($metadata['Categories']) {
                foreach ($metadata['Categories'] as $category) {
                    $categories[] = $category['name'];
                }
            }
            $parsing->categories = implode(',',$categories);
            if (isset($metadata['Hours'])) {
                $parsing->work = json_encode($metadata['Hours']);
            }
            $phones = array();
            if (isset($metadata['Phones'])) {
                foreach ($metadata['Phones'] as $phone) {
                    $phones[] = $phone['formatted'];
                }
            }
            $parsing->phones = implode(',',$phones);
            $parsing->name = $item['properties']['name'];
            $parsing->url = isset($metadata['url']) ? $metadata['url'] : '';
            $parsing->filters = isset($metadata['Features']) ? json_encode($metadata['Features']) : null;
            $parsing->save(false);
        }
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
                $this->redirect(array('admin'));
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
        $model->validate();
        $this->setPageTitle('Редактирование '.$model->name,false);
        $this->initAdminMenu();

        if (isset($_POST['ParsingData'])) {
            $model->attributes = $_POST['ParsingData'];
            if($model->save()) {
                $this->redirect(array('admin'));
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
        $model->status = 'obtained';
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