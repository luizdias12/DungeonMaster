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

        for($i=1;$i < 7;$i++)
        {
            $d = Resources::rollDice();
            self::$dices[] = $d;
        }
        arsort(self::$dices);
        self::$dices = array_values(self::$dices);

        $map = MapClass::getData(self::$class_id); 
        $map = $map[0];       

        $result = [];
        foreach($map as $i => $k)
        {
            $result[$k] = self::$dices[$i];
        }

        $attr[] = $result;
        $perc[]['perc'] = self::randomFloat();

        return array_merge(
            self::$name,
            self::$familyName,
            Gender::show(self::$gender_id),
            Races::show(self::$race_id),
            Classes::getData(self::$class_id),
            $attr,
            $perc
            // $map,
            // self::$attributes
            // array_combine(
            //     array_values(MapClass::getData(self::$class_id)),
            //     self::$attributes
            // )
        );
    }

    public static function easterEgg($race_id, $gender_id)
    {
        
    }

    public static function randomFloat($min = 0, $max = 100) {
        $result = round($min + mt_rand() / mt_getrandmax() * ($max - $min), 1);
        return $result;
    }

}