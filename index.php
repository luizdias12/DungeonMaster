<?php

ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/resources/functions/functions.php';

use App\Model\Randomizer;

$a = Randomizer::randomChar();

dd($a);
