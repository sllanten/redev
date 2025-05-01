<?php
require_once 'Router.php';

class App
{
    public function __construct()
    {
        $uri = $_GET['url'] ?? '';
        try {
            Router::route($uri);
        } catch (Throwable $e) {
            error_log(date('[Y-m-d H:i:s] ') . "Code Error: " . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../logs/code.log');
            echo "Ocurrió un error interno.";
        }
    }
}
