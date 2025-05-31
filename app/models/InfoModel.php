<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class InfoModel extends Model
{
    public function getSuscription($codigo): ?array{
        $stmt = $this->db->prepare("
        SELECT 
            i.id,
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
                'status' => 403,
                'data' => []
            ];
        }

    }

    public function getAllRedes(){
        $stmt = $this->db->prepare("SELECT id, red, pass, fechareg, fechamod FROM info");
        $stmt->execute();
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
