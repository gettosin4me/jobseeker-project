<?php

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/');
$dotenv->load();

return [
    'dbname' => getenv('DB_NAME'),
    'user' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'host' => getenv('DB_HOST'),
    'driver' => 'pdo_mysql',
];