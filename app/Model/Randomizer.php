<?php

namespace App\Model;

class Randomizer
{
    private static $gender_id;
    private static $race_id;
    private static $name;
    private static $familyName;
    private static $class_id;
    private static $dices = [];

    /**
     * gera valores para um personagem de forma aleatoria
     *
     * @return array
     */
    public static function randomChar()
    {
        self::$gender_id = Gender::getRandomGenderId();
        self::$race_id = Races::getRandomRaceId();
        self::$class_id = Classes::getRandomClassId();
        self::$name = Names::getRandomName(self::$gender_id, self::$race_id);
        if (self::$race_id == 4) {
            self::$familyName = FamilyNames::getRandomFamilyName(rand(2, 3));
        } else if (self::$race_id == 5) {
            self::$familyName[] = array('last_name' => '');
        } else {
            self::$familyName = FamilyNames::getRandomFamilyName(self::$race_id);
        }

        for ($i = 0; $i < 7; $i++) {
            $d = Resources::rollDice();
            self::$dices[] = $d;
        }
        arsort(self::$dices);
        array_pop(self::$dices);
        self::$dices = array_values(self::$dices);

        $map = MapClass::getData(self::$class_id);
        $map = $map[0];

        $result = [];
        foreach ($map as $i => $k) {
            $result[$k] = self::$dices[$i];
        }

        // echo self::$race_id . ", " . Races::show(self::$race_id)[0]['race'] . "<br>";
        // dumper($map);
        // dumper(self::$dices);

        $perc = self::randomFloat();

        if (empty(self::easterEgg($perc))) {
            $order = ["Força", "Destreza", "Constituição", "Inteligência", "Sabedoria", "Carisma"];          
            $ordered = [];

            foreach ($order as $key) {
                if (isset($result[$key])) {
                    $ordered[$key] = $result[$key];
                }
            }
            // dumper($ordered);
            $race_map = MapRace::getData(self::$race_id);
            // dumper($race_map);
            $adjustedScores = handleRaceScore($race_map, $ordered);

            // echo "atributos de retorno: <br>";
            // dd($adjustedScores);

            return array(
                "first_name" => self::$name[0]['first_name'],
                "last_name" => self::$familyName[0]['last_name'],
                "gender" => Gender::show(self::$gender_id)[0]['gender'],
                "race" => Races::show(self::$race_id)[0]['race'],
                "class" => Classes::getData(self::$class_id)[0]['class'],
                "category" => "Comum",
                "perc" => $perc,
                "attributes" => $adjustedScores,
            );
        } else { 
            return self::easterEgg($perc);
        }

    }

    public static function easterEgg($perc)
    {
        // dd(Specials::getRandomSpecialId($perc));
        $data = Specials::getData(Specials::getRandomSpecialId($perc), $perc);
        if(!empty($data)){
            $attributes = array(
                "Força" => $data["str"],
                "Destreza" => $data["dex"],
                "Constituição" => $data["con"],
                "Inteligencia" => $data["int"],
                "Sabedoria" => $data["wis"],
                "Carisma" => $data["cha"]
            );
            unset($data["str"],$data["dex"],$data["con"],$data["int"],$data["wis"],$data["cha"]);
            $data["attributes"] = $attributes;
        }
        return $data;
    }

    public static function randomFloat($min = 0, $max = 100)
    {
        $result = round($min + mt_rand() / mt_getrandmax() * ($max - $min), 1);
        return $result;
    }

}