<?php

namespace App\Model;

class Randomizer
{
    private static $gender_id;
    private static $race_id;
    private static $subrace_id;
    private static $name;
    private static $familyName;
    private static $class_id;

    /**
     * gera valores para um personagem de forma aleatoria
     *
     * @return array
     */
    public static function randomChar()
    {
        $dices = [];
        $genderId = Gender::getRandomGenderId();
        $raceId = Races::getRandomRaceId();
        $subraceId = SubRaces::getRandomSubRaceId($raceId);
        $classId = Classe::getRandomClassId();
        $name = Names::getRandomName($genderId, $raceId);
        if ($raceId == 4) {
            $familyName = FamilyNames::getRandomFamilyName(rand(2, 3));
        } elseif ($raceId == 5) {
            $familyName = [['last_name' => '']];
        } else {
            $familyName = FamilyNames::getRandomFamilyName($raceId);
        }

        for ($i = 0; $i < 7; $i++) {
            $d = Resources::rollDice();
            $dices[] = $d;
        }
        arsort($dices);
        array_pop($dices);
        $dices = array_values($dices);

        $map = MapClass::getData($classId);
        $map = $map[0];

        $result = [];
        foreach ($map as $i => $k) {
            $result[$k] = $dices[$i];
        }

        $perc = self::randomFloat();
        $egg = self::easterEgg($perc);

        if (empty($egg)) {
            $order = ["Força", "Destreza", "Constituição", "Inteligência", "Sabedoria", "Carisma"];
            $ordered = [];

            foreach ($order as $key) {
                if (isset($result[$key])) {
                    $ordered[$key] = $result[$key];
                }
            }

            $race_map = MapRace::getData($raceId);
            $adjustedScores = handleRaceScore($race_map, $ordered);

            return array(
                "nome" => $name[0]['first_name'] ?? '',
                "nome_familia" => $familyName[0]['last_name'] ?? '',
                "genero" => Gender::show($genderId)[0]['gender'] ?? '',
                "raça" => Races::show($raceId)[0]['race'] ?? '',
                "subraça" => SubRaces::show($subraceId)[0]['subrace'] ?? '',
                "classe" => Classe::getData($classId)[0]['class'] ?? '',
                "categoria" => "Comum",
                "perc" => $perc,
                "atributos" => $adjustedScores,
            );
        } else {
            return [];
        }
    }

    public static function easterEgg($perc)
    {
        // dd(Specials::getRandomSpecialId($perc));
        $data = Specials::getData(Specials::getRandomSpecialId($perc), $perc);
        if (empty($data)) {
            return [];
        }

        $atributos = [
            "Força" => $data["str"] ?? 0,
            "Destreza" => $data["dex"] ?? 0,
            "Constituição" => $data["con"] ?? 0,
            "Inteligencia" => $data["int"] ?? 0,
            "Sabedoria" => $data["wis"] ?? 0,
            "Carisma" => $data["cha"] ?? 0
        ];
        
        unset(
            $data["str"],
            $data["dex"],
            $data["con"],
            $data["int"],
            $data["wis"],
            $data["cha"]
        );

        return [
            "nome" => $data["first_name"] ?? '',
            "nome_familia" => $data["last_name"] ?? '',
            "genero" => $data["gender"] ?? '',
            "raça" => $data["race"] ?? '',
            "subraça" => '',
            "classe" => $data["class"] ?? '',
            "categoria" => $data["category"] ?? '',
            "perc" => $data["perc"] ?? '',
            "atributos" => $atributos
        ];
    }

    public static function randomFloat($min = 0, $max = 100)
    {
        $result = round($min + mt_rand() / mt_getrandmax() * ($max - $min), 1);
        return $result;
    }
}
