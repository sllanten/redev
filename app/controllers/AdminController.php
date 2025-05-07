<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/ApiController.php';
class AdminController extends Controller
{
    
    public function index(){
        $this->validateMidware();
        $this->view('login', [
            'title' => 'Devsllanten',
            'css' => ['/assets/css/login.css'],
            'js' => ['/assets/js/app.js', '/assets/js/login.js']
        ]);
    }

    public function dasboard(){
        $this->guardMidware();
        $this->view('dasboard', [
            'title' => 'Devsllanten',
            'css' => ['/assets/css/dasboard.css'],
            'js' => ['/assets/js/app.js']
        ]);
    }

    public function exitDasboard(){
        $this->exitApp();
        $response = [
            'status'    => 200
        ];
        echo json_encode($response);
    }

    public function adminConf(){
        $this->guardMidware();
        $this->view('configuracion', [
            'title' => 'Devsllanten',
            'css' => ['/assets/css/dasboard.css'],
            'js' => ['/assets/js/app.js']
        ]);
    }

    public function adminListDark(){
        $this->guardMidware();
        $this->view('listdark', [
            'title' => 'Devsllanten',
            'css' => ['/assets/css/dasboard.css'],
            'js' => ['/assets/js/app.js']
        ]);        
    }
}
