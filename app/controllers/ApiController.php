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
        if ((int)$result['status']== 403) {
            $response = [
                'status'    => (int)$result['status'],
                'textInfo' => '❌ Código inválido, acceso denegado.',
                'info'=> 403
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
}
