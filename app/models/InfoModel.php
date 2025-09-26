<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class InfoModel extends Model
{

    public function saveSuscription(array $data): array{
        $stmt = $this->db->prepare("INSERT INTO suscripcion (id_usuario, id_info, estado ,fecha) VALUES (:idUser, :idRed, :estado, :fecha)");
        $success = $stmt->execute([
            ':idUser' => $data['idUser'],
            ':idRed' => $data['idRed'],
            ':estado' => 1,
            ':fecha' => $data['fecha']
        ]);
        return $success ? ['status' => 200] : ['status' => 401];
    }

    public function getSuscription($codigo): array{

        $checkStmt = $this->db->prepare("SELECT COUNT(*) FROM usuario WHERE codigo = :codigo");
        $checkStmt->execute([':codigo' => $codigo]);
        $exists = $checkStmt->fetchColumn();

        if ($exists == 0) {
            return [
                'status' => 401,
                'data' => []
            ];
        }else {

            $stmt = $this->db->prepare("
                SELECT 
                    s.id,
                    i.red,
                    i.pass,
                    s.fecha,
                    u.id as idUser
                FROM 
                    suscripcion s
                INNER JOIN 
                    info i ON s.id_info = i.id
                INNER JOIN 
                    usuario u ON s.id_usuario = u.id
                WHERE 
                    s.estado = 1 AND u.codigo = :codigo;
            ");
            $stmt->execute([':codigo' => $codigo]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($result)) {
                return [
                    'status' => 200,
                    'data' => $result
                ];
            } else {
                return [
                    'status' => 404,
                    'data' => []
                ];
            }
        }

    }

    public function deleteSuscription(int $id): ?array{
        $stmt = $this->db->prepare("UPDATE suscripcion SET estado = 2 WHERE id = :id");
        $success = $stmt->execute([
            ':id' => (int)$id
        ]);
        return $success ? ['status' => 200] : ['status' => 401];
    }

    public function getAllRedes(){
        $stmt = $this->db->prepare("SELECT id, red, pass, fechareg, fechamod FROM info");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOnlyRedes($id){
        $stmt = $this->db->prepare("
            SELECT info.id, info.red, info.pass, info.fechareg, info.fechamod
            FROM info
            LEFT JOIN suscripcion 
            ON suscripcion.id_info = info.id AND suscripcion.id_usuario = :id_usuario
            WHERE suscripcion.id IS NULL
            OR suscripcion.estado <> 1
        ");
        $stmt->execute(['id_usuario' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveRed(array $data): array{
        $checkStmt = $this->db->prepare("SELECT COUNT(*) FROM info WHERE red = :red");
        $checkStmt->execute([':red' => $data['newName']]);
        $exists = $checkStmt->fetchColumn();

        if ($exists > 0) {
            return ['status' => 409];
        }

        $stmt = $this->db->prepare("INSERT INTO info (red, pass, fechareg, fechamod, id_usuario) VALUES (:red, :pass, :fechareg, :fechamod, :id_usuario)");
        $success = $stmt->execute([
            ':red' => $data['newName'],
            ':pass' => $data['newPass'],
            ':fechareg' => $data['newFecha'],
            ':fechamod' => $data['fechamod'],
            ':id_usuario' => $data['id_usuario']
        ]);
        return $success ? ['status' => 200] : ['status' => 401];
    }

    public function updateRed(array $data): array{
        $stmt = $this->db->prepare("UPDATE info SET red = :red, pass = :pass , fechamod= :fechamod WHERE id = :id");
        $success= $stmt->execute([
            ':red' => $data['EditName'],
            ':pass' => $data['EditPass'],
            ':fechamod' => $data['fechamod'],
            ':id' => (int)$data['idRed']
        ]);
        return $success ? ['status' => 200] : ['status' => 401];
    }    

    public function deleteRed(int $id): array{
        $stmt = $this->db->prepare("DELETE FROM info WHERE id = :id");
        $success = $stmt->execute([':id' => $id]);

        if ($success && $stmt->rowCount() > 0) {
            $status= 200;
        }else {
            $status= 403;
        }
        return [
            'status' => $status
        ];
    }
}
