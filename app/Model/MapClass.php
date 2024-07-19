<?php

namespace App\Model;

use App\Model\DB;
use PDO;
use PDOException;

class MapClass extends DB
{
    private static $collection = [];

    public static function index()
    {
        $stmt = parent::connect()->query("SELECT * FROM abilities_map_class");
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
        $stmt = parent::connect()->prepare("SELECT * FROM abilities_map_class WHERE id = :id");
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
            a1.ability_name '0', a2.ability_name '1', a3.ability_name '2', a4.ability_name '3', a5.ability_name '4', a6.ability_name '5'
            FROM abilities_map_class amc
            INNER JOIN classes c ON c.id = amc.class_id
            INNER JOIN abilities a1 ON a1.id = amc.index_1
            INNER JOIN abilities a2 ON a2.id = amc.index_2
            INNER JOIN abilities a3 ON a3.id = amc.index_3
            INNER JOIN abilities a4 ON a4.id = amc.index_4
            INNER JOIN abilities a5 ON a5.id = amc.index_5
            INNER JOIN abilities a6 ON a6.id = amc.index_6
            WHERE amc.class_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

}