<?php
return array_merge_recursive(
    include dirname(__FILE__).'/global.php',
    array(
        'components'=>array(
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
            'cache'=>array(
                'class'=>'system.caching.CFileCache',
                'cachePath' => 'cache/moscow/',
            ),
        ),

        'params'=>array(
            'city'       => 'Москва',
            'avatar'     => 'moskva',
            'forum'      => 2,
            'debug'      => true
        ),
    )
);