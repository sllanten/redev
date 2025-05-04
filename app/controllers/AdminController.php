<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/ApiController.php';
class AdminController extends Controller
{
    
    public function index(){
        $this->view('login', [
            'title' => 'Devsllanten',
            'css' => ['/assets/css/login.css'],
            'js' => ['/assets/js/app.js', '/assets/js/login.js']
        ]);
    }

    public function dasboard(){
        $this->guardMidware();
        $this->view('dasboard', [
            'title' => 'Devsllanten'
        ]);
    }

    public function exitDasboard(){
        $this->exitApp();
    }
}
