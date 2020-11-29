<?php

function env ($name, $default = null)
{
    if ($env = getenv($name)) {
        return $env;
    }

    return $default;
}

return [
    'database' => [
        'driver' => 'mysql',
        'charset' => 'utf8',
        'host' => env('DB_HOST', 'mysql'),
        'name' => env('DB_NAME', 'webdev'),
        'port' => env('DB_PORT', '3306'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', 'password'),
    ]
];
