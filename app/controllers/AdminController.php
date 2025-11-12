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
            'js' => ['/assets/js/app.js', '/assets/js/admin.js'],
            'components' => [
                'head' => [
                    'file' => 'header',
                    'data' => [
                        'endpoints' => $this->getEndpoint('admin')
                    ]
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
            'js' => ['/assets/js/app.js', '/assets/js/red.js'],
            'components' => [
                'head' => [
                    'file' => 'header',
                    'data' => [
                        'endpoints' => $this->getEndpoint('admin')
                    ]
                ],
                'nav' => [
                    'file' => 'navbarAdmin'
                ]
            ]
        ]);        
    }

    public function adminAcces(){
        $this->guardMidware();
        $this->view('admin.accesnode', [
            'title' => 'Devsllanten',
            'css' => ['/assets/css/dasboard.css'],
            'js' => ['/assets/js/app.js', '/assets/js/acces.js'],
            'components' => [
                'head' => [
                    'file' => 'header',
                    'data' => [
                        'endpoints' => $this->getEndpoint('admin')
                    ]                    
                ],
                'nav' => [
                    'file' => 'navbarAdmin'
                ]
            ]
        ]);        
    }

    public function messageSerch($id = null){
        $this->controllerMidware($id);

        $msgModel = $this->model('MsgModel');
        $json = json_encode($msgModel->getMsgOnly((int)$id));
        $response = json_decode($json);
        return $response->message;
    }
    
    public function getEndpoint($code = null){
        $this->controllerMidware($code);
        $msgModel = $this->model('ApiModel');
        return $msgModel->getEndPoint();
    }

    public function getCrackedFile(){
        $this->guardMidware();
        
        // Leer el archivo JSON desde la nueva ruta
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/db/listDark/cracked.json';
        
        if (!file_exists($filePath)) {
            echo json_encode(['status' => 404, 'message' => 'Archivo no encontrado']);
            return;
        }
        
        $jsonContent = file_get_contents($filePath);
        $crackedData = json_decode($jsonContent, true);
        
        if (!is_array($crackedData)) {
            echo json_encode(['status' => 400, 'message' => 'Formato JSON inválido']);
            return;
        }
        
        echo json_encode([
            'status' => 200,
            'data' => $crackedData
        ]);
    }

    public function saveCrackedData(){
        $this->guardMidware();
        
        // Obtener los datos del request
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        
        if (!isset($data['records']) || !is_array($data['records'])) {
            echo json_encode(['status' => 400, 'message' => 'Datos inválidos']);
            return;
        }
        
        // Guardar en la base de datos
        $infoModel = $this->model('InfoModel');
        $result = $infoModel->saveMassiveRedes($data['records']);
        
        echo json_encode($result);
    }

    public function getCurrentUser(){
        $this->guardMidware();
        
        $userId = (int)getUserSeccion();
        
        echo json_encode([
            'status' => 200,
            'user_id' => $userId
        ]);
    }
}
