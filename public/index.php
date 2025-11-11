<?php

// Cargar autoloader de Composer
require __DIR__ . '/../vendor/autoload.php';

// Cargar funciones helpers globales
require_once __DIR__ . '/../helpers/functions.php';

// Obtener URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Manejar la ruta
App\Core\Router::route($uri);
