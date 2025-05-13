<?php

namespace App\Core;

class Controller
{
    /**
     * @param string $view     Nombre de la vista (sin .php)
     * @param array  $data     Variables que quieres pasar a la vista
     * @param array  $assets   ['css' => [...paths], 'js' => [...paths]]
     */
    public function view($view, $data = [], array $assets = []){
        $this->dataView($data,$assets);

        extract($data);

        $component = [];

        if (!empty($data['components']) && is_array($data['components'])) {
            foreach ($data['components'] as $key => $comp) {
                $file = $comp['file'] ?? null;
                $compData = $comp['data'] ?? [];

                if ($file) {
                    $path = __DIR__ . '/../app/views/components/' . $file . '.php';

                    if (file_exists($path)) {
                        extract($compData);
                        ob_start();
                        require $path;
                        $component[$key] = ob_get_clean();
                    } else {
                        $component[$key] = "<!-- Componente '$file' no encontrado -->";
                    }
                }
            }
        }

        $viewPath = str_replace('.', '/', $view);
        $file = __DIR__ . '/../app/views/' . $viewPath . '.php';

        if(file_exists($file)) {
            require $file;
        }else {
            echo "⚠️ La vista '$viewPath.php' no se encontró.";
        }
    }

    public function model($model){
        $modelName = 'App\\Models\\' . $model;
        if (!class_exists($modelName)) {
            throw new \RuntimeException("Model not found: $modelName");
        }

        return new $modelName();
    }

    public function dataView($data=[], array $assets = []){
        $original = $data;
        extract($data);
        $data = $original;

        $styles  = $assets['css'] ?? [];
        $scripts = $assets['js']  ?? [];
    }

    protected function config(){
        $varModel = $this->model('varModel');
        return $varModel->getVar();
    }

    protected function guardMidware(){
        session_start();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            $config= $this->config();
            header('Location: '.$config[0]['token']);
            exit();
        }
    }

    protected function exitApp(){
        session_start();
        session_unset();     
        session_destroy();
    }

    protected function validateMidware(){
        session_start();
        if (isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == true) {
            $config = $this->config();
            $url= $config[0]['token']."admin/dasboard";
            header('Location: ' . $url);
        }
    }
}
