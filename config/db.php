<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=mysql;port=3306;dbname=complex-db',
    'username' => 'complex-app',
    'password' => 'F1@2n3i4l5',

//    'dsn' => getenv('POSTGRES_ENGINE').':host=localhost;port='.getenv('POSTGRES_PORT').';dbname='.getenv('POSTGRES_DB'),
//    'username' => getenv('POSTGRES_USER'),
//    'password' => getenv('POSTGRES_PASSWORD'),

    'charset' => 'utf8'
//    'enableSchemaCache' => true,
//    'schemaCacheDuration' => 3600,
//    'schemaCache' => 'cache',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
