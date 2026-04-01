<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\CharacterController;

$action = $_GET['action'] ?? 'random';

switch ($action) {
    case 'random':
    default:
        (new CharacterController())->random();
        break;
}
