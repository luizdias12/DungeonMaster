<?php

namespace App\Model;

use App\Model\DB;
use PDO;
use PDOException;

class Gender extends DB
{
    private static $collection = [];

    public static function index()
    {
        $stmt = self::connect()->query("SELECT * FROM gender");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
    }

    public static function show($id)
    {
        $stmt = self::connect()->prepare("SELECT * FROM gender WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$collection[] = $row;
        }
        return self::$collection;
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

    public static function getRandomGenderId()
    {
        $stmt = parent::connect()->query("SELECT id FROM gender ORDER BY RAND() LIMIT 1");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row['id'];
        }
    }
}

