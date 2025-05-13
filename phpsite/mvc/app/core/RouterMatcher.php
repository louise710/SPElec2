<?php
namespace App\Core;

class RouteMatcher {
    public function match(array $routes, string $requestMethod, string $requestPath): ?array {
        foreach ($routes as $route) {
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $route['path']);
            $pattern = "@^" . $pattern . "$@D";

            if ($route['method'] === $requestMethod && preg_match($pattern, $requestPath, $matches)) {
                return [
                    'handler' => $route['handler'],
                    'middleware' => $route['middleware'] ?? null,
                    'params' => array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY)
                ];
            }
        }
        return null;
    }
}