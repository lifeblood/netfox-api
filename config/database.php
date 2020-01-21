<?php

return [

    'default' => 'WHQJAccountsDB',
    'connections' => [
        env('DB_DATABASE_Accounts') => [
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE_Accounts'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        env('DB_DATABASE_Agent') => [
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE_Agent'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        env('DB_DATABASE_GameMatch') => [
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE_GameMatch'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        env('DB_DATABASE_GameScore') => [
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE_GameScore'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        env('DB_DATABASE_Group') => [
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE_Group'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        env('DB_DATABASE_NativeWeb') => [
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE_NativeWeb'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        env('DB_DATABASE_Platform') => [
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE_Platform'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        env('DB_DATABASE_PlatformManager') => [
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE_PlatformManager'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        env('DB_DATABASE_Record') => [
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE_Record'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'options' => array(
                PDO::ATTR_STRINGIFY_FETCHES => false,
                PDO::SQLSRV_ATTR_FETCHES_NUMERIC_TYPE => true  // int type not convert string
            ),
            'prefix_indexes' => true,
        ],

        env('DB_DATABASE_Treasure') => [
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE_Treasure'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'timezone'  => env('DB_TIMEZONE','+00:00'),
            'options' => array(
                PDO::ATTR_STRINGIFY_FETCHES => false,
                PDO::SQLSRV_ATTR_FETCHES_NUMERIC_TYPE => true
            ),
//            'prefix_indexes' => true,
        ],
    ],

    'redis' => [
        'cluster' => false,
        'client' => env('REDIS_CLIENT', 'predis'),
        'default' => [
            'host'     => env('REDIS_HOST', '127.0.0.1'),
            'port'     => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DATABASE', 0),
            'password' => env('REDIS_PASSWORD', ''),
        ],

    ],
];