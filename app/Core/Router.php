<?php

namespace App\Core;

use Closure;
use App\Core\Request;
use App\Core\Response;

class Router
{
    private array $routes = [];

    public function get(string $path, callable|array $action): void
    {
        $this->addRoute('GET', $path, $action);
    }

    public function post(string $path, callable|array $action): void
    {
        $this->addRoute('POST', $path, $action);
    }

    public function put(string $path, callable|array $action): void
    {
        $this->addRoute('PUT', $path, $action);
    }

    public function delete(string $path, callable|array $action): void
    {
        $this->addRoute('DELETE', $path, $action);
    }

    private function addRoute(string $method, string $path, callable|array $action): void
    {
        $this->routes[$method][$this->normalizePath($path)] = $action;
    }

    public function dispatch(string $uri, string $httpMethod): void
    {
        $path = $this->normalizePath(parse_url($uri, PHP_URL_PATH) ?? '/');
        $routes = $this->routes[$httpMethod] ?? [];

        foreach ($routes as $route => $action) {
            $pattern = $this->convertRouteToRegex($route);

            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches);
                $this->execute($action, $matches);
                return;
            }
        }

        $this->json([
            'success' => false,
            'message' => 'Rota não encontrada'
        ], 404);
    }

    private function execute(callable|array $action, array $params = []): void
    {
        if (is_array($action)) {
            [$controller, $controllerMethod] = $action;

            if (!class_exists($controller)) {
                $this->json([
                    'success' => false,
                    'message' => 'Controller não encontrado'
                ], 500);
                return;
            }

            $controllerInstance = new $controller();

            if (!method_exists($controllerInstance, $controllerMethod)) {
                $this->json([
                    'success' => false,
                    'message' => 'Método do controller não encontrado'
                ], 500);
                return;
            }

            $request = new Request();

            $response = $controllerInstance->$controllerMethod($request, ...$params);

            if (is_array($response)) {
                Response::json($response);
            } elseif ($response !== null) {
                echo $response;
            }

            return;
        }

        if ($action instanceof Closure || is_callable($action)) {
            $response = $action(...$params);

            if ($response !== null) {
                echo $response;
            }

            return;
        }

        $this->json([
            'success' => false,
            'message' => 'Ação de rota inválida'
        ], 500);
    }

    private function convertRouteToRegex(string $route): string
    {
        $pattern = preg_replace('/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/', '([^/]+)', $route);
        return '#^' . $pattern . '$#';
    }

    private function normalizePath(string $path): string
    {
        if ($path !== '/') {
            $path = rtrim($path, '/');
        }

        return $path ?: '/';
    }

    private function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}