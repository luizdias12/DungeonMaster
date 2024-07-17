<?php

namespace Model;

use App\Model\DB;
use PDO;
use PDOException;

class Character extends DB
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
        $stmt = parent::connect()->query("SELECT * FROM temp_char");
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
        $stmt = parent::connect()->query("SELECT c.name, g.gender, r.race
        FROM temp_char c
        INNER JOIN gender g on g.id = c.gender_id
        INNER JOIN races r on r.id = c.race_id");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

    public static function show($id)
    {
        $stmt = parent::connect()->prepare("SELECT * FROM temp_char WHERE id = :id");
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
                $stmt = parent::connect()->exec("INSERT INTO temp_char ($keys) VALUES ($values)");
                echo "New char \"{$values}\" inserted <br />";
            } catch (PDOException $e) {
                echo "Error on insert: {$e->getMessage()}";
            }
            // echo "$keys ----- $values";
        }
    }

    public static function delete($id)
    {
        $stmt = parent::connect()->prepare("DELETE FROM temp_char WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        try {
            $stmt->execute();
            echo "Char of id {$id} deleted <br />";
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
