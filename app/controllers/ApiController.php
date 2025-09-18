<?php

namespace App\Controllers;

use App\Core\Controller;
class ApiController extends Controller
{

    public function validateCode(){
        $this->guardApiMidware();

        $input = file_get_contents("php://input");
        $data = json_decode($input, true);
        $codigo = $data['code'];

        $infoModel = $this->model('InfoModel');
        $result = $infoModel->getSuscription($codigo);

        if ((int)$result['status'] == 200) {
            $response = [
                'status'    => (int)$result['status'],
                'textInfo' => '✅ Código correcto, acceso concedido.',
                'info'=> $result['data']
            ];
        }
        if ((int)$result['status']== 401) {
            $response = [
                'status'    => (int)$result['status'],
                'textInfo' => '❌ Código inválido, acceso denegado.',
                'info'=> 401
            ];
        }
        if ((int)$result['status']== 404) {
            $response = [
                'status'    => (int)$result['status'],
                'textInfo' => '❌ No tienes activa ninguna suscripcion.',
                'info'=> 404
            ];
        }

        echo json_encode($response);
    }

    public function validateLogin(){
        $this->guardApiMidware();

        $data = json_decode(file_get_contents('php://input'), true);
        $code = $data['code'] ?? '';

        $userModel = $this->model('UserModel');
        $user = $userModel->getLogin($code);

        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = true;

            echo json_encode(['status' => 200]);
        } else {
            echo json_encode(['status' => 403, 'message' => 'Código inválido']);
        }
    }

    public function getMessage(){
        $this->guardApiMidware();

        $msgModel = $this->model('MsgModel');
        echo json_encode($msgModel->getMsg());
    }

    public function messageSerch(){
        $this->guardApiMidware();

        $input = file_get_contents("php://input");
        $data = json_decode($input, true);
        $id = $data['codeMessage'];

        $msgModel = $this->model('MsgModel');
        $json = json_encode($msgModel->getMsgOnly($id));
        $dataJson = json_decode($json);

        if($dataJson->message === null){
            $response = [
                'status'    => 404,
                'message' => 'mensaje no encontrado en el APi.',
            ];
            echo json_encode($response, true);
        }else{
            $response = [
                'status'    => 200,
                'message' => $dataJson->message,
            ];
            echo json_encode($response,true);
        }
    }

    public function getUser(){
        $this->guardApiMidware();

        $msgModel = $this->model('UserModel');
        echo json_encode($msgModel->getAllUser());
    }

    public function createClient(){
        $this->guardApiMidware();

        $request = json_decode(file_get_contents('php://input'), true);
        $model = $this->model('UserModel');

        $data['nom'] = $request['client'];
        $data['cod'] = $request['codigo'];

        echo json_encode($model->saveDataUser($data));
    }

    public function createSubs(){
        $this->guardApiMidware();

        $data = json_decode(file_get_contents('php://input'), true);
        $msgModel = $this->model('InfoModel');

        $resultados = [];

        foreach ($data['checkRed'] as $idRed) {
            $registro = [
                'idRed' => $idRed,
                'idUser' => (int)$data['idUser'],
                'fecha' => $data['fechaLimt']
            ];

            $resultado = $msgModel->saveSuscription($registro);
            $resultados[] = [
                'idRed' => $idRed,
                'status' => $resultado['status']
            ];
        }

        echo json_encode([
            'total' => count($resultados),
            'insertados' => count(array_filter($resultados, fn($r) => $r['status'] === 200)),
            'fallidos' => count(array_filter($resultados, fn($r) => $r['status'] !== 200)),
            'detalles' => $resultados
        ]);
    }

    public function getSubs(){
        $this->guardApiMidware();

        $data = json_decode(file_get_contents('php://input'), true);
        $code = $data['code'] ?? '';

        $msgModel = $this->model('InfoModel');
        echo json_encode($msgModel->getSuscription($code));
    }

    public function getLIst(){
        $this->guardApiMidware();

        $msgModel = $this->model('InfoModel');
        echo json_encode($msgModel->getAllRedes());
    }

    public function deleteSub(){
        $this->guardApiMidware();

        $data = json_decode(file_get_contents('php://input'), true);
        $id = (int)$data['code'] ?? '';

        $msgModel = $this->model('InfoModel');
        echo json_encode($msgModel->deleteSuscription($id));
    }

    public function getListNewSub(){
        $this->guardApiMidware();

        $input = file_get_contents("php://input");
        $data = json_decode($input, true);
        $id = (int)$data['code'];

        $msgModel = $this->model('InfoModel');
        echo json_encode($msgModel->getOnlyRedes($id));
    }

    public function deleteRed(){
        $this->guardApiMidware();

        $input = file_get_contents("php://input");
        $data = json_decode($input, true);
        $id = $data['code'];

        $infoModel= $this->model(('InfoModel'));
        echo json_encode($infoModel->deleteRed((int)$id));
    }

    public function createList(){
        $this->guardApiMidware();

        $input = file_get_contents("php://input");
        $request = json_decode($input, true);
        
        $data['newName']= $request['newName'];
        $data['newPass']= $request['newPass'];
        $data['newFecha']= getYear();
        $data['fechamod']= getYear();
        $data['id_usuario']= getUserSeccion();
        
        $infoModel= $this->model('InfoModel');
        echo json_encode($infoModel->saveRed($data));
    }

    public function updateList(){
        $this->guardApiMidware();

        $input = file_get_contents("php://input");
        $request = json_decode($input, true);
        
        $data['idRed']= (int)$request['idRed'];
        $data['EditName']= $request['EditName'];
        $data['EditPass']= $request['EditPass'];
        $data['fechamod']= getYear();
        
        $infoModel= $this->model('InfoModel');
        echo json_encode($infoModel->updateRed($data));
    }

    public function getEndPointApi(){
        $this->guardApiMidware();

        $apiModel= $this->model('ApiModel');
        echo json_encode($apiModel->getEndPointApi());
    }

    public function updateMessage(){
        $this->guardApiMidware();

        $input = file_get_contents("php://input");
        $request = json_decode($input, true);

        $data['id'] = $request['id'];
        $data['msg'] = $request['msg'];
        $data['tipo'] = $request['tipo'];
        $data['class'] = $request['class'];

        $msgModel = $this->model('MsgModel');
        echo json_encode($msgModel->updateMsg($data));
    }

    public function createMessage(){
        $this->guardApiMidware();

        $input = file_get_contents("php://input");
        $request = json_decode($input, true);

        $data['msg'] = $request['msg'];
        $data['tipo'] = $request['tipo'];
        $data['clase'] = $request['class'];

        $msgModel = $this->model('MsgModel');
        echo json_encode($msgModel->saveMsg($data));
    }

    public function createEndPoint() {
        $this->guardApiMidware();

        $input = file_get_contents("php://input");
        $request = json_decode($input, true);

        $data['nombre'] = $request['nombre'];
        $data['descripcion'] = $request['descripcion'];
        $data['url'] = $request['url'];

        $msgModel = $this->model('ApiModel');
        echo json_encode($msgModel->saveEndPoint($data));
    }    

    public function updateEndPoint() {
        $this->guardApiMidware();

        $input = file_get_contents("php://input");
        $request = json_decode($input, true);

        $data['id'] = (int)$request['id'];
        $data['nombre'] = $request['nom'];
        $data['descripcion'] = $request['des'];
        $data['url'] = $request['link'];

        $msgModel = $this->model('ApiModel');
        echo json_encode($msgModel->updateRed($data));
    }

    public function getSoli() {
        $this->guardApiMidware();

        $msgModel = $this->model('SoliModel');
        echo json_encode($msgModel->getSoli());
    }

    public function createSoli() {
        $this->guardApiMidware();

        $input = file_get_contents("php://input");
        $request = json_decode($input, true);

        $data['cliente'] = $request['cliente'];
        $data['celular'] = (int)$request['celular'];        
        $data['fecha'] = getYear();
        $data['estado'] = 1;

        $msgModel = $this->model('SoliModel');
        echo json_encode($msgModel->saveSoli($data));

    }

    public function updateSoli() {
        $this->guardApiMidware();

        $input = file_get_contents("php://input");
        $request = json_decode($input, true);

        $data['idSoli'] = (int)$request['idSoli'];
        $data['estado'] = (int)$request['estado'];

        $msgModel = $this->model('SoliModel');
        echo json_encode($msgModel->updateSoli($data));
    }
}
