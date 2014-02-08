<?php
return array_merge_recursive(
    include dirname(__FILE__).'/global.php',
    array(
        'modules'=>array(
            'gii'=>array(
                'class'     => 'system.gii.GiiModule',
                'password'  => '080388',
                'ipFilters' => array('127.0.0.1','::1'),
            ),
        ),
        'components'=>array(
            'db'=>array(
                'class'                 => 'CDbConnection',
                'connectionString'      => 'mysql:host=localhost;dbname=kudapojti_chelny',
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
            'cache'=>array(
                'class'=>'system.caching.CFileCache',
                'cachePath' => 'cache/moscow/',
            ),
        ),
        'params'=>array(
            'city'       => 'Москва',
            'avatar'     => 'chelny',
            'forum'      => 2,
            'debug'      => true
        ),
    )
);