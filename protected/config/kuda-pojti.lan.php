<?php
return array(
	'basePath'       => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'           => 'Куда пойти',
	'sourceLanguage' => 'en',
	'language'       => 'ru',
	'preload'        => array('log'),
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.filters.*',
		'application.forms.*'
	),
	'modules'=>array(
		'gii'=>array(
			'class'     => 'system.gii.GiiModule',
			'password'  => '080388',
			'ipFilters' => array('127.0.0.1','::1'),
		),
	),
	'components'=>array(
        /*'cache'=>array(
        		'class'     =>'system.caching.CDummyCache',
        ),*/
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
		'db'=>array(
            'class'                 => 'CDbConnection',
            'connectionString'      => 'mysql:host=localhost;dbname=kudapojti_moscow',
            'username'              => 'root',
            'password'              => '',
            'emulatePrepare'        => true,
			'charset'               => 'utf8',
	        'schemaCachingDuration' => 3600
        ),
        'forumdb'=>array(
            'class'                 => 'CDbConnection',
            'connectionString'      =>'mysql:host=localhost;dbname=kudapojti_forum',
            'username'              => 'root',
            'password'              => '',
            'emulatePrepare'        => true,
            'charset'               => 'utf8',
            'schemaCachingDuration' => 3600
        ),
		'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'  => 'ext.yiidebugtb.XWebDebugRouter',
					'config' => 'alignLeft, opaque, runInDebug, fixedPos, yamlStyle',
		            'levels' => 'error, warning, trace, profile, info',
		            
				),
			),
		),
        'cache'=>array(
            'class'=>'system.caching.CFileCache',
            'cachePath' => 'cache/moscow/',
        ),
	),
	'params'=>array(
		'adminEmail' => 'zymanch@gmail.com',
	    'city'       => 'Москва',
        'avatar'     => 'moskva',
        'forum'      => 2,
        'debug'      => true
	),
);