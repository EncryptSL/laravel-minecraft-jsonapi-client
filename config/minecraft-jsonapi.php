<?php


return [
    'ip'       => env('MINECRAFT_JSONAPI_IP', '127.0.0.1'),
    'port'     => (int) env('MINECRAFT_JSONAPI_PORT', 20059),
    'username' => env('MINECRAFT_JSONAPI_USERNAME', 'admin'),
    'password' => env('MINECRAFT_JSONAPI_PASSWORD', 'changeme'),
];
