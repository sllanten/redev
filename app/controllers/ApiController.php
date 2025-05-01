<?php
require_once __DIR__ . '/../../core/Controller.php';
class ApiController extends Controller
{

    public function getStatus($code){
        $userModel = $this->model('UserModel');
        $codigos =  $userModel->getCode();

        $soloCodigos = array_column($codigos, 'codigo');
        $status = (in_array($code, $soloCodigos)) ? 200 : 403;

        return $status;
    }

    public function getId($code){
        $infoModel = $this->model('InfoModel');
        $rows = $infoModel->getId($code);
        return (int)$rows['id'];
    }    

    public function validateCode(){
        header("Content-Type: application/json");
        $input = file_get_contents("php://input");
        $data = json_decode($input, true);
        $code = $data['code'];

        $status = $this->getStatus($code);
        $idUser= $this->getId($code);

        $infoModel = $this->model('InfoModel');
        $rows = $infoModel->getUser($idUser);

        if ($status == 200) {
            $response = [
                'status'    => $status,
                'textInfo' => '✅ Código correcto, acceso concedido.',
                'info'=> $rows
            ];
        }
        if ($status == 403) {
            $response = [
                'status'    => $status,
                'textInfo' => '❌ Código inválido, acceso denegado.',
                'info'=> 403
            ];
        }

        echo json_encode($response);
    }


}
