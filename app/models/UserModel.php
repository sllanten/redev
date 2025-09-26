<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class UserModel extends Model
{

    public function getAllUser(){
        $stmt = $this->db->prepare("
        SELECT 
            u.id,
            u.nombre,
            u.codigo,
            COUNT(CASE WHEN s.estado = 1 THEN 1 END) AS suscripcion
        FROM 
            usuario u
        LEFT JOIN 
            suscripcion s ON u.id = s.id_usuario
        GROUP BY 
            u.id, u.nombre, u.codigo;
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);        
    }

    public function saveDataUser(array $data): array{
        $stmt = $this->db->prepare("INSERT INTO usuario (nombre, codigo, rol) VALUES (:nombre, :codigo, :rol)");
        $success =$stmt->execute([
            ':nombre' => $data['nom'],
            ':codigo' => $data['cod'],
            ':rol' => 2,
        ]);
        
        return $success ? ['status' => 200] : ['status' => 401];
    }

    public function upDataUser(array $data): array {
        $checkStmt = $this->db->prepare("SELECT COUNT(*) FROM usuario WHERE codigo = :codigo AND id != :id");
        $checkStmt->execute([
            ':codigo' => $data['cod'],
            ':id'     => $data['id']
        ]);
        $exists = $checkStmt->fetchColumn();

        if ($exists > 0) {
            return ['status' => 409];
        }

        $stmt = $this->db->prepare("UPDATE usuario SET nombre = :nombre, codigo = :codigo WHERE id = :id");
        $success = $stmt->execute([
            ':nombre' => $data['nom'],
            ':codigo' => $data['cod'],
            ':id'     => (int)$data['id'],
        ]);

        return $success ? ['status' => 200] : ['status' => 401];
    }

    public function delDataUser(int $id): bool{
        $stmt = $this->db->prepare("DELETE FROM usuario WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getLogin($codigo){
        $stmt = $this->db->prepare("SELECT id FROM usuario WHERE codigo = :codigo AND rol = 1");
        $stmt->execute([':codigo' => $codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
