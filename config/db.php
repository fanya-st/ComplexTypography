<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=mysql;port=3306;dbname=complex-db',
    'username' => 'complex-app',
    'password' => 'F1@2n3i4l5',

//    'dsn' => 'pgsql:host=postgres;port=5432;dbname=complex-db',
//    'username' => 'complex-app',
//    'password' => 'F1@2n3i4l5',

    'charset' => 'utf8'
//    'enableSchemaCache' => true,
//    'schemaCacheDuration' => 3600,
//    'schemaCache' => 'cache',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
