<?php

namespace App\Model;

use App\Model\DB;
use PDO;
use PDOException;

class SubRaces extends DB
{
    private static $collection = [];

    public static function index()
    {
        $stmt = self::connect()->query("SELECT * FROM subraces");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

    public static function create($id_race, $subraces = array())
    {
        if (count($subraces) > 0) {
            foreach ($subraces as $subrace) {
                $stmt = self::connect()->prepare("INSERT INTO subraces (id_race, subrace) VALUES (:id_race, :subrace)");
                $stmt->bindParam(':id_race', $id_race);
                $stmt->bindParam(':subrace', $subrace);
                try {
                    $stmt->execute();
                    echo "New subrace \"{$subrace}\" inserted <br />";
                } catch (PDOException $e) {
                    echo "Error on insert subrace '{$subrace}': {$e->getMessage()} <br />";
                }
            }
        }
    }

    public static function show($id)
    {
        $stmt = self::connect()->prepare("SELECT * FROM subraces WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

    public static function showByRace($id_race)
    {
        $stmt = self::connect()->prepare("SELECT * FROM subraces WHERE id_race = :id_race");
        $stmt->bindParam(':id_race', $id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

    public static function delete($id)
    {
        $stmt = self::connect()->prepare("DELETE FROM subraces WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        try {
            $stmt->execute();
            echo "SubRace of id {$id} deleted <br />";
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
            echo "The data is empty";
        }
    }

    public static function getRandomSubRaceId($id_race)
    {
        $stmt = self::connect()->prepare("SELECT id FROM subraces WHERE id_race = :id_race ORDER BY RAND() LIMIT 1");
         $stmt->bindParam(':id_race', $id_race);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row ? $row['id'] : false;
        }
    }
}
