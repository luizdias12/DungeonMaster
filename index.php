<?php

ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Model\Names;
use App\Model\Races;
use App\Model\FamilyNames;
use App\Model\Randomizer;
use App\Model\Resources;
use App\Model\Classes;
use App\Model\Character;

$a = Randomizer::randomChar();
$keys = [$a[4]['key_ability'], $a[4]['key_ability_2']];

Resources::checkKey($keys);

echo "<pre>";
print_r($a);
echo "</pre>";

$values = [];
for($i=1;$i < 7;$i++)
{
    $d = Resources::rollDice();
    $values[] = $d;
}

arsort($values);

echo "<pre>";
print_r($values);
echo "</pre>";