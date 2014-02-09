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
    'components'=>array(
        'user'=>array(
            'class' => 'WebUser',
            'allowAutoLogin'=>true,
        ),
        'authManager'=>array(
            'class' => 'AuthManager',
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
        'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
            // 'params'=>array('directory'=>'/opt/local/bin'),
        ),
    ),
    'params'=>array(
        'adminEmail' => 'zymanch@gmail.com',
        'salt' => 'fds78$',
    ),
);