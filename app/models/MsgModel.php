<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class MsgModel extends Model
{
    public function getMsg(): array{
        $stmt = $this->db->prepare("SELECT id, mensaje FROM mensajes");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $formatted = [];
        foreach ($result as $row) {
            $formatted[] = [
                'id' => $row['id'],
                'message' => $row['mensaje']
            ];
        }

        return $formatted;
    }

    public function getMsgOnly(int $id): array{
        $stmt = $this->db->prepare("SELECT mensaje as message FROM mensajes WHERE id= :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: ['message' => null];
    }    

}