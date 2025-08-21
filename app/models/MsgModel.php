<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class MsgModel extends Model
{
    public function getMsg(){
        $stmt = $this->db->prepare("SELECT id, mensaje, tipo,class FROM mensajes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMsgOnly(int $id): array{
        $stmt = $this->db->prepare("SELECT mensaje as message FROM mensajes WHERE id= :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: ['message' => null];
    }

}