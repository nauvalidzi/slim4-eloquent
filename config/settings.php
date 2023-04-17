<?php

// Should be set to 0 in production
error_reporting(E_ALL);

// Should be set to '0' in production
ini_set('display_errors', '1');

// Settings
$settings = [
    'determineRouteBeforeAppMiddleware' => false,
    'displayErrorDetails' => true,
];

$settings['db'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'express',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => ''
];
// ...

return $settings;