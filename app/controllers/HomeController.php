<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Controllers\ApiController;


class HomeController extends Controller
{

    private $tokenLink;
    private $apiController;
    private $msg;

    public function __construct(){
        $conf = configApp();
        $this->tokenLink = $conf['tokenLink'];

        $this->apiController = new ApiController();
        $this->msg = $this->apiController->messageGuest();
    }

    public function index(){
        $this->view('home', [
            'title' => 'Devsllanten',
            'textInfo' => $this->msg['msgGuest'],
            'tokenLink' => $this->tokenLink,
            'css' => ['/assets/css/home.css'],
            'js'  => ['/assets/js/app.js', '/assets/js/home.js'],
            'components' => [
                'head' => [
                    'file' => 'header'
                ],
                'nav' => [
                    'file' => 'navbarGuest'
                ]
            ]
        ]);
    }
}
