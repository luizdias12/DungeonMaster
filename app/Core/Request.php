<?php

namespace App\Core;

class Request
{
    private array $routeParams = [];
    private ?array $jsonData = null;

    public function input(string $key, $default = null)
    {
        $data = array_merge($this->json(), $_POST, $_GET, $this->routeParams);
        return $data[$key] ?? $default;
    }

    public function all(): array
    {
        return array_merge($this->json(), $_GET, $_POST, $this->routeParams);
    }

    public function json(): array
    {
        if ($this->jsonData !== null) {
            return $this->jsonData;
        }

        $raw = file_get_contents('php://input');
        $decoded = json_decode($raw, true);

        $this->jsonData = is_array($decoded) ? $decoded : [];

        return $this->jsonData;
    }

    public function query(?string $key = null, $default = null)
    {
        if ($key === null) {
            return $_GET;
        }

        return $_GET[$key] ?? $default;
    }

    public function post(?string $key = null, $default = null)
    {
        if ($key === null) {
            return $_POST;
        }

        return $_POST[$key] ?? $default;
    }

    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function uri(): string
    {
        return $_SERVER['REQUEST_URI'] ?? '/';
    }

    public function header(string $key, $default = null)
    {
        $headers = function_exists('getallheaders') ? getallheaders() : [];
        $headers = array_change_key_case($headers, CASE_LOWER);

        return $headers[strtolower($key)] ?? $default;
    }

    public function setRouteParams(array $params): void
    {
        $this->routeParams = $params;
    }

    public function route(?string $key = null, $default = null)
    {
        if ($key === null) {
            return $this->routeParams;
        }

        return $this->routeParams[$key] ?? $default;
    }
}