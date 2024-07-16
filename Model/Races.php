<?php

namespace Model;

use Model\DB;
use PDO;
use PDOException;

class Races extends DB
{
    private static $collection = [];

    public static function index()
    {
        $stmt = self::connect()->query("SELECT * FROM races");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

    public static function create($data = array())
    {
        if(count($data) > 0){
            foreach($data as $key => $value) {
                $stmt = self::connect()->prepare("INSERT INTO races (race) VALUES (:race)");
                $stmt->bindParam(':race', $value);
                try {
                    $stmt->execute();
                    echo "New race \"{$value}\" inserted <br />";
                } catch(PDOException $e){
                    echo "Error on insert: {$e->getMessage()}";
                }
            }
        }
    }

    public static function show($id)
    {
        $stmt = self::connect()->prepare("SELECT * FROM races WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                self::$collection[] = $row;
            }
            return self::$collection;
    }

    public static function delete($id)
    {
        $stmt = self::connect()->prepare("DELETE FROM races WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        try {
            $stmt->execute();
            echo "Race of id {$id} deleted <br />";
        } catch(PDOException $e){
            echo "Error on delete: {$e->getMessage()}";
        }
    }

    public static function dismantle($data = array())
    {
        if(count($data) > 0){
            foreach($data as $key => $value) {
                echo "$key :: $value <br />";
            }
        } else {
            echo "The data is empty";
        }
    }
}

