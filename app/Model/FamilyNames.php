<?php

namespace App\Model;

use App\Model\DB;
use PDO;
use PDOException;

class FamilyNames extends DB
{
    private static $collection = [];

    private static function formatStr($value)
    {
        if (is_string($value)) {
            return "'" . $value . "'";
        } else {
            return $value;
        }
    }

    public static function index()
    {
        $stmt = parent::connect()->query("SELECT * FROM lastnames");
        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                self::$collection[] = $row;
            }
            return self::$collection;
        } else {
            echo "No data!";
        }
    }

    public static function showChars()
    {
        $stmt = parent::connect()->query("SELECT n.last_name, g.gender, r.race
        FROM lastnames n
        INNER JOIN gender g on g.id = n.gender_id
        INNER JOIN races r on r.id = n.race_id");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

    public static function show($id)
    {
        $stmt = parent::connect()->prepare("SELECT * FROM lastnames WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

    public static function create($data = array())
    {
        if (count($data) > 0) {
            $arr_v = array_map("self::formatStr", array_values($data));
            $values = implode(",", $arr_v);
            $keys = implode(",", array_keys($data));
            try {
                parent::connect()->exec("INSERT INTO lastnames ($keys) VALUES ($values)");
                echo "New lastname \"{$values}\" inserted <br />";
            } catch (PDOException $e) {
                echo "Error on insert: {$e->getMessage()}";
            }
            // echo "$keys ----- $values";
        }
    }

    public static function delete($id)
    {
        $stmt = parent::connect()->prepare("DELETE FROM lastnames WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        try {
            $stmt->execute();
            echo "Lastname of id {$id} deleted <br />";
        } catch (PDOException $e) {
            echo "Error on delete: {$e->getMessage()}";
        }
    }

    public static function dismantle($data = array())
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                echo "$key :: $value <br />";
            }
        } else {
            echo "The data array is empty";
        }
    }

    public static function countBy()
    {
        $stmt = parent::connect()->query("SELECT r.race, COUNT(*) AS qtd
        FROM lastnames ln
        INNER JOIN races r on r.id = ln.race_id
        GROUP BY r.race
        ORDER BY r.race");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

    public static function getRandomFamilyName($race_id)
    {
        $stmt = parent::connect()->prepare("SELECT last_name FROM lastnames WHERE race_id = :race_id ORDER BY RAND() LIMIT 1");
        $stmt->bindParam(':race_id', $race_id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }
}