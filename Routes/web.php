<?php

use App\Controller\CharacterController;
use App\Controller\HomeController;
use App\Controller\DateTimeController;
use App\Controller\ClasseController;

/** @var $router App\Core\Router */

$router->get('/', [HomeController::class, 'home']);

$router->get('/character/random', [CharacterController::class, 'random']);

$router->get('/datetime/formats', [DateTimeController::class, 'formats']);

$router->get('/classes/index', [ClasseController::class, 'index']);
$router->get('/classes/{id}', [ClasseController::class, 'show']);