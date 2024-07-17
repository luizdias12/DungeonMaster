<?php

namespace Model;

use App\Model\DB;
use PDO;
use PDOException;

class Classes extends DB
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
        $stmt = self::connect()->query("SELECT * FROM names");
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
        $stmt = self::connect()->query("SELECT n.first_name, g.gender, r.race
        FROM names n
        INNER JOIN gender g on g.id = n.gender_id
        INNER JOIN races r on r.id = n.race_id");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

    public static function show($id)
    {
        $stmt = self::connect()->prepare("SELECT * FROM names WHERE id = :id");
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
                $stmt = self::connect()->exec("INSERT INTO names ($keys) VALUES ($values)");
                echo "New name \"{$values}\" inserted <br />";
            } catch (PDOException $e) {
                echo "Error on insert: {$e->getMessage()}";
            }
            // echo "$keys ----- $values";
        }
    }

    public static function delete($id)
    {
        $stmt = self::connect()->prepare("DELETE FROM names WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        try {
            $stmt->execute();
            echo "Name of id {$id} deleted <br />";
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
}