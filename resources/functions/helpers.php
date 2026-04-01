<?php

if (!function_exists('dd')) {
    function dd(mixed ...$values): never
    {
        echo '<pre style="
            background: #1e1e1e;
            color: #08CB00;
            padding: 16px;
            border-radius: 8px;
            font-family: Consolas, monospace;
            font-size: 14px;
            line-height: 1.5;
            overflow:auto;
        ">';

        foreach ($values as $value) {
            print_r($value);
            echo "\n\n";
        }

        echo '</pre>';
        die();
    }
}

if (!function_exists('dump')) {
    function dump(mixed ...$values): void
    {
        echo '<pre style="
            background: #1e1e1e;
            color: #8CE4FF;
            padding: 16px;
            border-radius: 8px;
            font-family: Consolas, monospace;
            font-size: 14px;
            line-height: 1.5;
            overflow:auto;
        ">';

        foreach ($values as $value) {
            var_dump($value);
            echo "\n";
        }

        echo '</pre>';
    }
}

if (!function_exists('dumper')) {
    function dumper(mixed $value): void
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }
}

if (!function_exists('redirect')) {
    function redirect(string $url): never
    {
        header("Location: {$url}");
        exit;
    }
}

if (!function_exists('basePath')) {
    function basePath(string $path = ''): string
    {
        $base = dirname(__DIR__, 2);
        return $path ? $base . '/' . ltrim($path, '/') : $base;
    }
}

if (!function_exists('view')) {
    function view(string $view, array $data = [], string $layout = 'layouts/main'): void
    {
        extract($data);

        $viewPath = basePath("app/View/{$view}.php");
        $layoutPath = basePath("app/View/{$layout}.php");

        if (!file_exists($viewPath)) {
            die("View '{$view}' não encontrada.");
        }

        if (!file_exists($layoutPath)) {
            die("Layout '{$layout}' não encontrado.");
        }

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        require $layoutPath;
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        return '/' . ltrim($path, '/');
    }
}


if (!function_exists('jsonResponse')) {
    function jsonResponse(array $data, int $statusCode = 200): never
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();
    }
}

if (!function_exists('handleRaceScore')) {
    function handleRaceScore(array $raceMap, array $attributes): array
    {
        if (empty($raceMap) || empty($attributes)) {
            return $attributes;
        }

        foreach ($raceMap as $bonus) {
            $attributeName = $bonus['attribute'] ?? null;
            $attributeValue = $bonus['value'] ?? 0;

            if ($attributeName && isset($attributes[$attributeName])) {
                $attributes[$attributeName] += (int) $attributeValue;
            }
        }

        return $attributes;
    }
}
