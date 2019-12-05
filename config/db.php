<?php

$dsn = getenv('DB_ADAPTER') . ':host='. getenv('DB_HOST') .';dbname=' . getenv('DB_NAME');
$dsn .= ';port=' . getenv('DB_PORT');

return [
    'class' => \yii\db\Connection::class,
    'dsn' => $dsn,
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8'
];
