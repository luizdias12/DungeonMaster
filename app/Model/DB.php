<?php

namespace Model;

use \PDO;
use \PDOException;

class DB {

    public static function connect(){
        $host = 'localhost';
        $dbname = 'dungeonmaster';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $pass);
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}