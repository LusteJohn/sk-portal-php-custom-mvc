<?php

namespace App\Core;

use Closure;
use Exception;

class Router
{
    private array $routes = [];

    public function get($path, $handler)
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post($path, $handler)
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch($uri, $method)
    {
        $path = parse_url($uri, PHP_URL_PATH);

        $handler = $this->routes[$method][$path] ?? null;

        if (!$handler) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        // ✅ Handle Closure routes
        if ($handler instanceof Closure) {
            return $handler();
        }

        // ✅ Handle Controller routes
        if (is_array($handler)) {
            [$class, $function] = $handler;

            $controller = new $class();
            return $controller->$function();
        }

        throw new Exception("Invalid route handler type");
    }
}