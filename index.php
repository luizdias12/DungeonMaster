<?php


ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('DIR_APP', __DIR__);

require_once __DIR__.'/vendor/autoload.php';

use App\Model\Names;
use App\Model\Races;

$races = Races::index();
$names = Names::showChars();
echo "<pre>";
print_r($names);
echo "</pre>";
// exit;

//   $arrays = [];
//   for ($i = 0; $i < count($names); $i++) {
//     $arrays[] = [
//       "gender_id" => 2,
//       "race_id" => 1,
//       "first_name" => $names[$i]
//     ];
//     Names::create($arrays[$i]);
//   }



