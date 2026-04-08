<?php

namespace App\Model;

use App\Core\DB;
use PDO;
use PDOException;

class Classe extends DB
{

    public static function index(): array
    {
        return self::findWhere('classes', []);
    }

    public static function show(string $id): ?array
    {
        return self::findWhere('classes', ['id' => $id]);
    }

    public static function create(array $data): ?int
    {
        return self::insert('classes', $data);
    }

    public static function delete($id)
    {
        $stmt = parent::connect()->prepare("DELETE FROM classes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        try {
            $stmt->execute();
            echo "Class of id {$id} deleted <br />";
        } catch (PDOException $e) {
            echo "Error on delete: {$e->getMessage()}";
        }
    }

    public static function getRandomClassId(): ?int
    {
        $sql = "
            SELECT id FROM classes
            WHERE id >= (
                SELECT FLOOR(RAND() * (SELECT MAX(id) FROM classes))
            )
            ORDER BY id
            LIMIT 1
        ";

        $row = self::first($sql);

        return $row ? (int) $row['id'] : null;
    }

    public static function getData(string $id): array
    {
        $sql = "
            SELECT c.id, c.class, a1.ability_name key_ability, a2.ability_name key_ability_2
            FROM classes c
            INNER JOIN abilities a1 ON a1.id = c.key_ability
            LEFT JOIN abilities a2 ON a2.id = c.key_ability_2
            WHERE c.id = :id
        ";

        return self::first($sql, ['id' => $id]);
    }

}