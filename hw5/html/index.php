<?php

require '/vendor/autoload.php';
require '/src/config.php';

ini_set('display_errors', 'on');
ini_set('error_reporting', E_ALL | E_NOTICE);

$route = new \Base\Route();
$route->add(route: '/', controllerName: \App\Controller\UserController::class);
$route->add(route: '/register', controllerName: \App\Controller\UserController::class);

$app = new \Base\Application($route);
$app->run();