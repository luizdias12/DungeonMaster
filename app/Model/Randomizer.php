<?php

namespace App\Model;

class Randomizer
{
    private static $gender_id;
    private static $race_id;
    private static $name;
    private static $familyName;
    private static $class_id;
    private static $attributes = [];

    public static function randomChar()
    {
        self::$gender_id = rand(1, 2);
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

        $genderDesc = self::$gender_id == 1 ? 'Male' : 'Female';
        $gender[]['gender'] = $genderDesc;

        return array_merge(self::$name, self::$familyName, $gender, Races::show(self::$race_id), Classes::show(self::$class_id));
    }
}