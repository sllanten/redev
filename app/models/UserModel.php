<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class UserModel extends Model
{
    public function saveDataUser(array $data): bool{
        $stmt = $this->db->prepare("INSERT INTO usuario (nombre, codigo, rol) VALUES (:nombre, :codigo, :rol)");
        return $stmt->execute([
            ':nombre' => $data['nom'],
            ':codigo' => $data['cod'],
            ':rol' => $data['rol'],
        ]);
    }

    public function upDataUser(int $id, array $data): bool{
        $fecha = getYear();
        $stmt = $this->db->prepare("UPDATE usuario SET nombre = :nombre, codigo = :codigo , rol= :rol WHERE id = :id");
        return $stmt->execute([
            ':nombre' => $data['nom'],
            ':codigo' => $data['cod'],
            ':rol' => $data['rol'],
            ':id' => $id
        ]);
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
