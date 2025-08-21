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
}
