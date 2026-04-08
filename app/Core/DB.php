<?php

namespace App\Core;

use PDO;
use PDOException;

class DB
{
    private static ?PDO $conn = null;

    public static function connect(): PDO
    {
        if (self::$conn !== null) {
            return self::$conn;
        }

        $host = 'host';
        $dbname = 'dbname';
        $user = 'user';
        $pass = 'pass';
        $charset = 'utf8mb4';

        try {
            self::$conn = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=$charset",
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );

            return self::$conn;

        } catch (PDOException $e) {
            // 👇 melhor que echo
            throw new \Exception('Erro ao conectar ao banco');
        }
    }
}