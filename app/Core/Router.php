<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, callable|array $action): void
    {
        $this->routes['GET'][$path] = $action;
    }

    public function dispatch(string $uri, string $method): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        $action = $this->routes[$method][$path] ?? null;

        if (!$action) {
            http_response_code(404);
            echo "Rota não encontrada";
            return;
        }

        // Se for Controller
        if (is_array($action)) {
            [$controller, $method] = $action;

            $controllerInstance = new $controller();
            $controllerInstance->$method();
            return;
        }

        // Se for closure
        $action();
    }
}