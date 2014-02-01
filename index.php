<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$confPath = dirname(__FILE__).'/protected/config/%s.php';
$serverName = $_SERVER['SERVER_NAME'];
if (strpos($serverName, 'www.') === 0) {
    $serverName = substr($serverName, 4);
}
$configFile = sprintf($confPath, $serverName);
if (!file_exists($configFile)) {
    $config = sprintf($configFile, 'kuda-pojti.ru');
}
$config = include($configFile);
if ($config['params']['debug']) {
    define('YII_DEBUG', true);
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
} else {
    define('YII_DEBUG', false);
}
define('YII_ENABLE_EXCEPTION_HANDLER', false);
require_once($yii);
Yii::createWebApplication($configFile)->run();
