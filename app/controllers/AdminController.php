<?php

namespace App\Controllers;

use App\Core\Controller;

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

    public function exitDasboard(){
        $this->exitApp();
        $response = [
            'status'    => 200
        ];
        echo json_encode($response);
    }    

    public function dasboard(){
        $this->guardMidware();
        $this->view('admin.dasboard', [
            'title' => 'Devsllanten',
            'css' => ['/assets/css/dasboard.css'],
            'js' => ['/assets/js/app.js'],
            'components' => [
                'head' => [
                    'file' => 'header'
                ],
                'nav' => [
                    'file' => 'navbarAdmin'
                ]              
            ]
        ]);
    }

    public function adminConf(){
        $this->guardMidware();
        $this->view('admin.configuracion', [
            'title' => 'Devsllanten',
            'css' => ['/assets/css/dasboard.css'],
            'js' => ['/assets/js/app.js'],
            'components' => [
                'head' => [
                    'file' => 'header'
                ],
                'nav' => [
                    'file' => 'navbarAdmin'
                ]
            ]
        ]);
    }

    public function adminListDark(){
        $this->guardMidware();
        $this->view('admin.listdark', [
            'title' => 'Devsllanten',
            'css' => ['/assets/css/dasboard.css'],
            'js' => ['/assets/js/app.js'],
            'components' => [
                'head' => [
                    'file' => 'header'
                ],
                'nav' => [
                    'file' => 'navbarAdmin'
                ]
            ]
        ]);        
    }

    public function messageSerch($id){
        $msgModel = $this->model('MsgModel');
        $json = json_encode($msgModel->getMsgOnly((int)$id));
        $response = json_decode($json);
        return $response->message;
    }
    
    public function getEndpoint(){
        $msgModel = $this->model('ApiModel');
        return $msgModel->getEndPoint();
    }
}
