<?php

namespace App\Core;

class BaseController
{
    protected function success($data = null, array $meta = []): array
    {
        return [
            'success' => true,
            'data' => $data,
            'meta' => array_merge([
                'timestamp' => date('c')
            ], $meta),
            'error' => null
        ];
    }

    protected function error(string $message, int $code = 400): array
    {
        return [
            'success' => false,
            'data' => null,
            'meta' => [],
            'error' => [
                'message' => $message,
                'code' => $code
            ]
        ];
    }
}