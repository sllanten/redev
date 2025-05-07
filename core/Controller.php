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
        require_once __DIR__ . '/../app/views/' . $view . '.php';
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
