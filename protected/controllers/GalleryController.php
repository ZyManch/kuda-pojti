<?php

class GalleryController extends Controller {

    const FULL_IMAGE_WIDTH = 900;
    const FULL_IMAGE_HEIGHT = 700;
    const MINI_IMAGE_WIDTH = 190;
    const MINI_IMAGE_HEIGHT = 190;

    protected $model = 'Mesto';
    

	/**
	 * Екшен показа одной модели.
	 * @param string $id ID или URL модели
	 */
	public function actionMesto($id) {
		$model = $this->loadModel($id);
		$this->setPageTitle($model->title, false);
		$this->initPageMenu($model);
		$this->initAdminMenu($model);
		$this->includeCss('gallery');
		$this->includeJs('jquery.lightbox-0.5.min');
		$this->render('mesto', array(
			'model' => $model,
		    'images' => $model->images
		));
	}

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['gallery'])) {
            /** @var CUploadedFile[] $uploads */
            $uploads = CUploadedFile::getInstancesByName('gallery');
            foreach ($uploads as $index => $upload) {
                $info = getimagesize($upload->getTempName());
                $width = $info[0];
                $height = $info[1];
                $imagePath = 'images/gallery/'.Yii::app()->city->folder.'/'.$model->id.'/';
                $imageName = $this->_getNonExistsFile($imagePath,'.jpg');
                $miniImagePath = $imagePath.$imageName.'.jpg';
                $fullImagePath = $imagePath.$imageName.'_full.jpg';
                $miniZoom = max(self::MINI_IMAGE_WIDTH/$width,self::MINI_IMAGE_HEIGHT/$height);
                $fullZoom = max(self::FULL_IMAGE_WIDTH/$width,self::FULL_IMAGE_HEIGHT/$height);
                $gd = Yii::app()->image->load($upload->getTempName());
                if ($width > self::FULL_IMAGE_WIDTH || $height > self::FULL_IMAGE_HEIGHT) {
                    $gd->resize(self::FULL_IMAGE_WIDTH, self::FULL_IMAGE_HEIGHT, Image::AUTO);
                }
                $gd->save($fullImagePath);

                $gd = Yii::app()->image->load($upload->getTempName());
                $gd->resize(self::MINI_IMAGE_WIDTH, self::MINI_IMAGE_HEIGHT, Image::WIDTH);
                $gd->save($miniImagePath);

                $info = getimagesize($upload->getTempName());
                $image = new Images();
                $image->mesto_id = $model->id;
                $image->title = isset($_POST['gallery'][$index]) ? $_POST['gallery'][$index] : '';
                $image->width = $info[0];
                $image->height = $info[1];
                $image->preview = $miniImagePath;
                $image->url = $fullImagePath;
                if (!$image->save()) {
                    $errors = array();
                    foreach($image->getErrors() as $attribute => $messages) {
                        $errors[] = $attribute.': '.implode(',', $messages);
                    }
                    throw new Exception(implode('; ', $errors));
                }
            }
        }
        $this->setPageTitle($model->title, false);
        $this->initAdminMenu($model);
        $this->render('update', array(
            'model' => $model,
            'images' => $model->images
        ));
    }

    protected function _getNonExistsFile($path, $ext) {
        $i=1;
        while(file_exists($path.$i.$ext)) {
            $i++;
        }
        return $i;
    }

    public function initAdminMenu($model = null) {
        parent::initAdminMenu($model);
        if (isset($this->adminMenu['create'])) {
            $this->adminMenu['create']['url'] = array('create','id' => $model->url);
        }
    }


    /**
     * @param Mesto $model
     */
    public function _initAdminMenu($model = null) {
        $this->adminMenu = array();
        if (!is_null($model)) {
            $this->adminMenu['mesto'] = array('label'=>'Просмотр', 'url'=>array('mesto', 'id'=>$model->url),'image' => 'view');
            $this->adminMenu['update'] = array('label'=>'Редактировать', 'url'=>array('update', 'id'=>$model->url),'image' => 'update');
        }
    }
}
