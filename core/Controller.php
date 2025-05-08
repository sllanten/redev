<?php
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
        require_once __DIR__ . '/../app/models/' . $model . '.php';
        return new $model;
    }

    public function dataView($data=[], array $assets = []){
        $original = $data;
        extract($data);
        $data = $original;

        $styles  = $assets['css'] ?? [];
        $scripts = $assets['js']  ?? [];
    }

    protected function config(){
        $conf = configApp();
        return $conf['urlBase'];
    }

    protected function guardMidware(){
        session_start();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header('Location: '. $this->config());
            exit();
        }
    }

    protected function exitApp(){
        session_start();
        session_unset();     
        session_destroy();
    }

    protected function validateMidware(){
        $url= $this->config()."/admin/adminConf";
        session_start();
        if (isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == true) {
            header('Location: ' . $url);
        }
    }
}
