<?php

namespace App\Model;

use App\Model\DB;
use PDO;
use PDOException;

class Specials extends DB
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
        $stmt = parent::connect()->query("SELECT * FROM specials");
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
        $stmt = parent::connect()->prepare("SELECT * FROM specials WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

    public static function create($data = [])
    {
        if (count($data) > 0) {
            $arr_v = array_map("self::formatStr", array_values($data));
            $values = implode(",", $arr_v);
            $keys = implode(",", array_keys($data));
            try {
                parent::connect()->exec("INSERT INTO specials ($keys) VALUES ($values)");
                echo "New special character \"{$values}\" inserted <br />";
            } catch (PDOException $e) {
                echo "Error on insert: {$e->getMessage()}";
            }
        } else {
            echo "The data array is empty";
        }
    }

    public static function delete($id)
    {
        $stmt = parent::connect()->prepare("DELETE FROM specials WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        try {
            $stmt->execute();
            echo "Special Character of id {$id} deleted <br />";
        } catch (PDOException $e) {
            echo "Error on delete: {$e->getMessage()}";
        }
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
    
    /**
     * getRandomSpecialId
     *
     * @param  float $perc
     */
    public static function getRandomSpecialId($perc)
    {
        $stmt = parent::connect()->prepare("SELECT id FROM category WHERE :perc BETWEEN perc_ini AND perc_final");
        $stmt->bindParam(':perc', $perc);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // dd($row);
            return $row['id'];
        }
    }
    
    /**
     * getData
     *
     * @param  int $id
     * @param  float $perc
     * @return array
     */
    public static function getData($id, $perc)
    {
        $stmt = parent::connect()->prepare("SELECT s.first_name, s.last_name, r.race, g.gender, c.class, 
            str, dex, con, `int`, wis, cha,
            ct.category, CONVERT($perc, DECIMAL(10,2)) AS perc
            FROM specials s
            INNER JOIN races r ON r.id = s.race_id
            INNER JOIN gender g ON g.id = s.gender_id
            INNER JOIN classes c ON c.id = s.class_id
            INNER JOIN category ct ON ct.id = s.category_id
            WHERE s.category_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection = $row;
        }
        return self::$collection;
    }

}