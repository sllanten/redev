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

    public function getIdUser($code){
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
        $idUser= $this->getIdUser($code);

        $infoModel = $this->model('InfoModel');
        $rows = $infoModel->getSuscription($idUser);

        if ((int)$status == 200) {
            $response = [
                'status'    => $status,
                'textInfo' => '✅ Código correcto, acceso concedido.',
                'info'=> $rows
            ];
        }
        if ((int)$status == 403) {
            $response = [
                'status'    => $status,
                'textInfo' => '❌ Código inválido, acceso denegado.',
                'info'=> 403
            ];
        }

        echo json_encode($response);
    }

    public function validateLogin(){
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Metodo no permitido']);
            return;
        }

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

    public function messageGuest(){
        $msgModel = $this->model('msgModel');
        return $msgModel->getMsgGuest();
    }


}
