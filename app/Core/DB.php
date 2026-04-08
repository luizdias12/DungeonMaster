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

        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
        $charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';

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

    public static function select(
        string $sql,
        array $params = []
    ): array {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function first(
        string $sql,
        array $params = []
    ): ?array {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch() ?: null;
    }

    public static function insert(
        string $table,
        array $data
    ): ?int {
        if (empty($data)) {
            return null;
        }

        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $stmt = self::connect()->prepare($sql);
        if (!$stmt->execute($data)) {
            return null;
        }

        return self::connect()->lastInsertId();
    }

    public static function update(
        string $table,
        string $keyColumn,
        $keyValue,
        array $data
    ): bool {
        if (empty($data)) {
            return false;
        }

        if (
            !preg_match('/^[a-zA-Z0-9_]+$/', $table) ||
            !preg_match('/^[a-zA-Z0-9_]+$/', $keyColumn)
        ) {
            throw new \Exception('Tabela ou coluna inválida');
        }

        $fields = [];
        foreach (array_keys($data) as $column) {
            $fields[] = "$column = :$column";
        }

        $setClause = implode(', ', $fields);
        $sql = "UPDATE {$table} SET {$setClause} WHERE {$keyColumn} = :keyfield";

        $params = $data;
        $params['keyfield'] = $keyValue;

        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);

        return $stmt->rowCount() > 0;
    }

    public function updateWhere(
        string $table,
        array $data,
        array $conditions
    ): bool {
        if (empty($data) || empty($conditions)) {
            return false;
        }

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            throw new \Exception('Tabela inválida');
        }

        $setFields = [];
        foreach (array_keys($data) as $column) {
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $column)) {
                throw new \Exception("Coluna inválida: {$column}");
            }

            $setFields[] = "{$column} = :set_{$column}";
        }

        $setClause = implode(', ', $setFields);

        $whereFields = [];
        foreach ($conditions as $column => $value) {
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $column)) {
                throw new \Exception("Coluna inválida: {$column}");
            }

            $whereFields[] = "{$column} = :where_{$column}";
        }

        $whereClause = implode(' AND ', $whereFields);

        $sql = "UPDATE {$table} SET {$setClause} WHERE {$whereClause}";

        $params = [];

        foreach ($data as $column => $value) {
            $params["set_{$column}"] = $value;
        }

        foreach ($conditions as $column => $value) {
            $params["where_{$column}"] = $value;
        }

        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);

        return $stmt->rowCount() > 0;
    }

    public static function deleteWhere(
        string $table,
        array $conditions
    ): bool {
        if (empty($conditions)) {
            return false;
        }

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            throw new \Exception('Tabela inválida');
        }

        $whereFields = [];
        foreach ($conditions as $column => $value) {
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $column)) {
                throw new \Exception("Coluna inválida: {$column}");
            }

            $whereFields[] = "{$column} = :where_{$column}";
        }

        $whereClause = implode(' AND ', $whereFields);

        $sql = "DELETE FROM {$table} WHERE {$whereClause}";

        $params = [];

        foreach ($conditions as $column => $value) {
            $params["where_{$column}"] = $value;
        }

        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);

        return $stmt->rowCount() > 0;
    }

    public static function findWhere(
        string $table,
        array $conditions = []
    ): ?array {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            throw new \Exception('Tabela inválida');
        }

        $sql = "SELECT * FROM {$table}";
        $params = [];

        if (!empty($conditions)) {
            $whereFields = [];

            foreach ($conditions as $column => $value) {
                if (!preg_match('/^[a-zA-Z0-9_]+$/', $column)) {
                    throw new \Exception("Coluna inválida: {$column}");
                }

                $whereFields[] = "{$column} = :where_{$column}";
                $params["where_{$column}"] = $value;
            }

            $whereClause = implode(' AND ', $whereFields);
            $sql .= " WHERE {$whereClause}";
        }

        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll() ?: null;
    }

    public static function execute(
        string $sql,
        array $params = []
    ): int {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    public static function lastInsertId(): string
    {
        return self::connect()->lastInsertId();
    }
}
