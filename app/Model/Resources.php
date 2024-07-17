<?php

namespace App\Model;

class Resources {
    public static $dices = [];
    public static function rollDice() {
        $dice_one = rand(1,6);
        $dice_two = rand(1,6);
        $dice_three = rand(1,6);
        $dice_four = rand(1,6);

        self::$dices = array($dice_one, $dice_two, $dice_three, $dice_four);
        sort(self::$dices);
        array_shift(self::$dices);
        return array_sum(self::$dices);
    }

    public static function checkKey($keys)
    {
        echo "<pre>";
        print_r($keys);
        echo "</pre>";
        echo count($keys);
    }
}