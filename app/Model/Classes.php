<?php

namespace App\Model;

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
        $stmt = parent::connect()->query("SELECT * FROM classes");
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
        $stmt = parent::connect()->prepare("SELECT * FROM classes WHERE id = :id");
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
                parent::connect()->exec("INSERT INTO classes ($keys) VALUES ($values)");
                echo "New class \"{$values}\" inserted <br />";
            } catch (PDOException $e) {
                echo "Error on insert: {$e->getMessage()}";
            }
        } else {
            echo "The data array is empty";
        }
    }

    public static function delete($id)
    {
        $stmt = parent::connect()->prepare("DELETE FROM class WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        try {
            $stmt->execute();
            echo "Class of id {$id} deleted <br />";
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

    public static function getRandomClassId()
    {
        $stmt = parent::connect()->query("SELECT id FROM classes ORDER BY RAND() LIMIT 1");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row['id'];
        }
    }

}