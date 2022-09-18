<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'postgresql:host=localhost;port=5432;dbname=complex-app',
//    'username' => 'complex-app',
    'username' => getenv('POSTGRES_USER'),
//    'password' => 'F1@2n3i4l5',
    'password' => getenv('POSTGRES_PASSWORD'),
    'charset' => 'utf8'
//    'enableSchemaCache' => true,
//    'schemaCacheDuration' => 3600,
//    'schemaCache' => 'cache',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
