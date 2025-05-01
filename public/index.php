<?php

require_once __DIR__ . '/../helpers/functions.php';
spl_autoload_register(function ($class) {
    foreach (['core', 'app/controllers', 'app/models'] as $folder) {
        $file = __DIR__ . '/../' . $folder . '/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

new App();
