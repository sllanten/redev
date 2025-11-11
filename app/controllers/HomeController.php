<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Controllers\AdminController;

class HomeController extends Controller
{

    private $adminController;

    public function __construct()
    {
        $this->adminController = new AdminController();
    }

    public function index(){
        $this->view('home', [
            'title' => 'Devsllanten',
            'textInfo' => $this->adminController->messageSerch(1),
            'tokenLink' =>  $this->config('tokenLink'),
            'css' => ['/assets/css/home.css'],
            'js'  => ['/assets/js/app.js', '/assets/js/home.js'],
            'components' => [
                'head' => [
                    'file' => 'header',
                    'data' => [
                        'endpoints' => $this->adminController->getEndpoint('admin')
                    ]
                ],
                'nav' => [
                    'file' => 'navbarGuest'
                ]
            ]
        ]);
    }
}
