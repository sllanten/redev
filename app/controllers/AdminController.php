<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/ApiController.php';
class AdminController extends Controller
{
    protected $apiController;

    public function __construct()
    {
        $this->apiController = new ApiController();
    }
    
    public function index(){
        $this->view('login', [
            'title' => 'Devsllanten',
            'css' => ['/assets/css/login.css'],
            'js' => ['/assets/js/login.js']
        ]);
    }


}
