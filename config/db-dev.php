<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=mysql;port='.env('MYSQL_PORT').';dbname='.env('MYSQL_DATABASE'),
    'username' => env('MYSQL_USER'),
    'password' => env('MYSQL_PASSWORD'),
    'charset' => 'utf8',
];
