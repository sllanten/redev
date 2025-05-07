<?php
require_once __DIR__ . '/../../core/Controller.php';
class HomeController extends Controller
{

    private $tokenLink;

    public function __construct()
    {
        $conf = configApp();
        $this->tokenLink = $conf['tokenLink'];
    }

    public function index(){
        $this->view('home', [
            'title' => 'Devsllanten',
            'textInfo'=> 'Welcome guest, enjoy!',
            'tokenLink'=> $this->tokenLink,
            'css' => ['/assets/css/home.css'],
            'js'  => ['/assets/js/app.js','/assets/js/home.js']
        ]);
    }
}
