<?php

namespace App\DTO;

class ClassDTO
{
    public static function format($data)
    {
        return [
            'id' => (int) $data['ID'],
            'name' => $data['NOME']
        ];
    }

    public static function collection($data)
    {
        return array_map([self::class, 'format'], $data);
    }
}