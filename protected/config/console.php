<?php
$config = include dirname(__FILE__).'/kuda-pojti.dev.php';
$config['commandMap'] = array(
    'migrate'=>array(
        'class'=>'system.cli.commands.MigrateCommand',
        'migrationPath'=>'application.migrations.'.$config['params']['migration'],
        'migrationTable'=>'migration',
    )
);

return $config;