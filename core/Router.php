<?php

namespace App\Core;

class Router
{
    public static function route($uri)
    {
        // Configuración de rutas
        $uri = trim($uri, '/');
        $segments = explode('/', $uri);

        // Determinar controlador y método
        $controllerName = !empty($segments[0])
            ? ucfirst($segments[0]) . 'Controller'
            : 'HomeController';
        $method = $segments[1] ?? 'index';

        // Namespace completo del controlador
        $controllerClass = 'App\\Controllers\\' . $controllerName;

        // Verificar si la clase existe (el autoloader se encargará de cargarla)
        if (!class_exists($controllerClass)) {
            self::handleError("Controller not found: $controllerClass");
            return;
        }

        // Crear instancia del controlador
        $controller = new $controllerClass();

        // Verificar método
        if (!method_exists($controller, $method)) {
            self::handleError("Method not found: $controllerClass@$method");
            return;
        }

        // Llamar al método
        call_user_func_array([$controller, $method], array_slice($segments, 2));
    }

    protected static function handleError($message)
    {
        $logFile = dirname(__DIR__, 2) . '/logs/conex.log';

        // Asegurar que el directorio de logs existe
        if (!file_exists(dirname($logFile))) {
            mkdir(dirname($logFile), 0755, true);
        }

        error_log(date('[Y-m-d H:i:s] ') . $message . PHP_EOL, 3, $logFile);
        http_response_code(404);
        echo "404 - " . htmlspecialchars($message);
        exit;
    }
}