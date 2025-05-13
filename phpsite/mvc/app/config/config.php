<?php
return [
    'database' => [
        'host' => 'localhost',
        'dbname' => 'rest_api',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4'
    ],
    'jwt' => [
        'secret' => 'secretparabibo',
        'algorithm' => 'HS256',
        'expiry' => 3600 // 1 hour
    ],
    'app' => [
        'base_url' => 'http://localhost:8000'
    ]
];