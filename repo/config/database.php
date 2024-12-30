<?php

use Illuminate\Support\Str;

$MYSQL_DEFAULT_CONNECTION = [
    'driver' => 'mysql',
    'url' => env('DB_URL'),
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'laravel'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', ''),
    'unix_socket' => env('DB_SOCKET', ''),
    'charset' => env('DB_CHARSET', 'utf8mb4'),
    'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
    ]) : [],
];

$REDIS_CLUSTER_CONNECTION =  [
    [
        'url' => env('REDIS_URL'),
        'host' => env('REDIS_HOST_1', '172.63.0.11'),
        'username' => env('REDIS_USERNAME'),
        'password' => env('REDIS_PASSWORD'),
        'port' => env('REDIS_PORT', '6379'),
        'database' => env('REDIS_DB', '0'),
    ],
    [
        'url' => env('REDIS_URL'),
        'host' => env('REDIS_HOST_2', '172.63.0.12'),
        'username' => env('REDIS_USERNAME'),
        'password' => env('REDIS_PASSWORD'),
        'port' => env('REDIS_PORT', '6379'),
        'database' => env('REDIS_DB', '0'),
    ],
    [
        'url' => env('REDIS_URL'),
        'host' => env('REDIS_HOST_3', '172.63.0.13'),
        'username' => env('REDIS_USERNAME'),
        'password' => env('REDIS_PASSWORD'),
        'port' => env('REDIS_PORT', '6379'),
        'database' => env('REDIS_DB', '0'),
    ],
    [
        'url' => env('REDIS_URL'),
        'host' => env('REDIS_HOST_4', '172.63.0.14'),
        'username' => env('REDIS_USERNAME'),
        'password' => env('REDIS_PASSWORD'),
        'port' => env('REDIS_PORT', '6379'),
        'database' => env('REDIS_DB', '0'),
    ],
    [
        'url' => env('REDIS_URL'),
        'host' => env('REDIS_HOST_5', '172.63.0.15'),
        'username' => env('REDIS_USERNAME'),
        'password' => env('REDIS_PASSWORD'),
        'port' => env('REDIS_PORT', '6379'),
        'database' => env('REDIS_DB', '0'),
    ],
    [
        'url' => env('REDIS_URL'),
        'host' => env('REDIS_HOST_6', '172.63.0.16'),
        'username' => env('REDIS_USERNAME'),
        'password' => env('REDIS_PASSWORD'),
        'port' => env('REDIS_PORT', '6379'),
        'database' => env('REDIS_DB', '0'),
    ],
];

return [
    'default' => env('DB_CONNECTION', 'mysql'),
    'connections' => [
        'mysql' => $MYSQL_DEFAULT_CONNECTION,
    ],

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'clusters' => [
            'default' => $REDIS_CLUSTER_CONNECTION,
            'cache' => $REDIS_CLUSTER_CONNECTION,
        ],
    ],
];
