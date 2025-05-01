<?php
class Router
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];
    
    public static function route($uri)
    {
        $uri = trim($uri, '/');
        $segments = explode('/', $uri);

        $controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
        $method = $segments[1] ?? 'index';

        $controllerFile = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            error_log(date('[Y-m-d H:i:s] ') . "404 Not Found: $uri" . PHP_EOL, 3, __DIR__ . '/../logs/conex.log');
            http_response_code(404);
            echo "404 - Ruta no encontrada.";
            return;
        }

        require_once $controllerFile;
        $controller = new $controllerName;

        if (!method_exists($controller, $method)) {
            error_log(date('[Y-m-d H:i:s] ') . "404 Method Not Found: $controllerName@$method" . PHP_EOL, 3, __DIR__ . '/../logs/conex.log');
            http_response_code(404);
            echo "404 - Método no encontrado.";
            return;
        }

        call_user_func_array([$controller, $method], array_slice($segments, 2));
    }
}
