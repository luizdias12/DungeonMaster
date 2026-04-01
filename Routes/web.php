<?php

use App\Controller\CharacterController;
use App\Controller\HomeController;

/** @var $router App\Core\Router */

$router->get('/', [HomeController::class, 'home']);

$router->get('/character/random', [CharacterController::class, 'random']);