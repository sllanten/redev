<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class InfoModel extends Model
{
    public function getId($codigo): array{
        $stmt = $this->db->prepare("SELECT id FROM usuario WHERE codigo= :codigo");
        $stmt->execute([':codigo' => $codigo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOnly(int $id): ?array{
        $stmt = $this->db->prepare("SELECT * FROM info WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }    

    public function getSuscription(int $id): ?array{
        $stmt = $this->db->prepare("
        SELECT 
            i.id,
            i.red,
            i.pass,
            s.fecha
        FROM 
            suscripcion s
        INNER JOIN 
            info i ON s.id_info = i.id
        INNER JOIN 
            usuario u ON s.id_usuario = u.id
        WHERE 
            s.estado = 1 AND u.id = :id;
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public function saveData(array $data): bool{
        $stmt = $this->db->prepare("INSERT INTO info (red, pass, fechareg, fechamod) VALUES (:red, :pass, :fechareg, :fechamod)");
        return $stmt->execute([
            ':red' => $data['red'],
            ':pass' => $data['pass'],
            ':fechareg' => getYear(),
            ':fechamod' => getYear(),
        ]);
    }

    public function upData(int $id, array $data): bool{
        $fecha = getYear();
        $stmt = $this->db->prepare("UPDATE info SET red = :red, pass = :pass , fechamod= :fechamod WHERE id = :id");
        return $stmt->execute([
            ':red' => $data['red'],
            ':pass' => $data['pass'],
            ':fechamod' => getYear(),
            ':id' => $id
        ]);
    }

    public function delData(int $id): bool{
        $stmt = $this->db->prepare("DELETE FROM info WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
