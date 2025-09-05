<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class ApiModel extends Model
{

    public function getEndPoint(): array{
        $stmt = $this->db->prepare("SELECT id, url FROM api");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $formatted = [];
        foreach ($result as $row) {
            $formatted[] = [
                'id' => $row['id'],
                'url' => $row['url']
            ];
        }

        return $formatted;
    }
    
    public function getEndPointApi(){
        $stmt = $this->db->prepare("SELECT id, descripcion ,nombre, url FROM api");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveEndPoint(array $data): array{
        $stmt = $this->db->prepare("INSERT INTO api (nombre ,descripcion, url, id_usuario) VALUES (:nombre, :descripcion, :url, :id_usuario)");
        $success = $stmt->execute([
            ':nombre' => $data['nombre'],
            ':descripcion' => $data['descripcion'],
            ':url' => $data['url'],
            ':id_usuario' => (int)getUserSeccion()
        ]);
        return $success ? ['status' => 200] : ['status' => 401];
    }

    public function updateRed(array $data): array {
        $stmt = $this->db->prepare("UPDATE api SET nombre = :nombre, descripcion = :descripcion , url= :url WHERE id = :id");
        $success = $stmt->execute([
            ':nombre' => $data['nombre'],
            ':descripcion' => $data['descripcion'],
            ':url' => $data['url'],
            ':id' => (int)$data['id']
        ]);
        return $success ? ['status' => 200] : ['status' => 401];
    }
}
