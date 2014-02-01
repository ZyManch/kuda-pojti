<?php
return array(
	'basePath'       => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'           => 'Куда пойти',
	'sourceLanguage' => 'en',
	'language'       => 'ru',

	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.filters.*',
		'application.forms.*'
	),







	'components'=>array(



		'user'=>array(
			'allowAutoLogin'=>true,
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				array(
					'class' => 'application.components.UrlRule',
				)
			),
		),
        'db' => array(
            'class'            => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=kuda_moscow',
            'username'         => 'kuda_pojti',
            'password'         => 'Chp3006w',
            'emulatePrepare'   => true,
            'charset' => 'utf8',
            'schemaCachingDuration' => 3600,
        ),
        'forumdb' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=kuda_forum',
            'username' => 'kuda_pojti',
            'password' => 'Chp3006w',
            'emulatePrepare' => true,
            'charset' => 'utf8',
            'schemaCachingDuration' => 3600
        ),
		'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
        'cache'=>array(
            'class'=>'system.caching.CFileCache',
            'cachePath' => 'cache/moscow/',
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
        'adminEmail' => 'zymanch@gmail.com',
        'city'       => 'Москва',
        'avatar'     => 'moskva',
        'forum'      => 2,
        'debug'      => true
	),
);