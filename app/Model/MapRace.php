<?php

namespace App\Model;

use App\Model\DB;
use PDO;
use PDOException;

class MapRace extends DB
{
    private static $collection = [];

    public static function index()
    {
        $stmt = parent::connect()->query("SELECT * FROM race_ability_score");
        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                self::$collection[] = $row;
            }
            return self::$collection;
        } else {
            echo "No data!";
        }
    }
    public static function show($id)
    {
        $stmt = parent::connect()->prepare("SELECT * FROM race_ability_score WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

    public static function dismantle($data = [])
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                echo "$key :: $value <br />";
            }
        } else {
            echo "The data array is empty";
        }
    }

    public static function getData($id)
    {
        $stmt = parent::connect()->prepare("SELECT
            a.ability_name, ras.`value`, ras.`action`
            FROM race_ability_score ras
            INNER JOIN races r ON r.id = ras.race_id
            INNER JOIN abilities a ON a.id = ras.ability_id
            WHERE ras.race_id = :id
            ORDER BY r.race, a.id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

}