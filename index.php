<?php

ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/resources/functions/functions.php';

use App\Model\Names;
use App\Model\Races;
use App\Model\FamilyNames;
use App\Model\Randomizer;
use App\Model\Resources;
use App\Model\Classes;
use App\Model\Character;
use App\Model\Gender;

$a = Randomizer::randomChar();
// $map = $a[4];
// $attr = $a[5];
// $result = [];

// foreach($map as $i => $k)
// {
//     $result[$k] = $attr[$i];
// }

dd($a);

// for($i=0;$i<count($names);$i++){
//     $insert = array(
//         "race_id" => 15,
//         "last_name" => $names[$i]
//     );
//     FamilyNames::create($insert);
// }