<?php
$config = include dirname(__FILE__).'/kuda-pojti.dev.php';
$config['commandMap'] = array(
    'migrate'=>array(
        'class'=>'app.console.MigrationCommand',
        'migrationPath'=>'application.migrations.'.$config['components']['city']['load'],
        'migrationTable'=>'migration',
    )
);

return $config;