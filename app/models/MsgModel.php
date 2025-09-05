<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class MsgModel extends Model
{
    public function getMsg(){
        $stmt = $this->db->prepare("SELECT id, mensaje, tipo, class FROM mensajes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMsgOnly(int $id): array{
        $stmt = $this->db->prepare("SELECT mensaje as message FROM mensajes WHERE id= :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: ['message' => null];
    }

    public function updateMsg(array $data): array{
        $stmt = $this->db->prepare("UPDATE mensajes SET mensaje = :msg, tipo = :tipo , class = :class WHERE id = :id");
        $success = $stmt->execute([
            ':msg' => $data['msg'],
            ':tipo' => $data['tipo'],
            ':class' => $data['class'],
            ':id' => $data['id']
        ]);
        return $success ? ['status' => 200] : ['status' => 401];
    }

    public function saveMsg(array $data): array{
        $stmt = $this->db->prepare("INSERT INTO mensajes (id_usuario ,mensaje, tipo, class) VALUES (:idUser, :msg, :tipo, :clase)");
        $success = $stmt->execute([
            ':idUser' => (int)getUserSeccion(),
            ':msg' => $data['msg'],
            ':tipo' => $data['tipo'],
            ':clase' => $data['clase']
        ]);
        return $success ? ['status' => 200] : ['status' => 401];
    }
}