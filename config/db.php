<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=mysite-local',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',

    'enableSchemaCache' => true,//YII_ENV_PROD,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
];
