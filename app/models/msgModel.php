<?php

require_once __DIR__ . '/../../core/Model.php';

class msgModel extends Model
{
    public function getMsgGuest(): array{
        $stmt = $this->db->prepare("SELECT mensaje as msgGuest FROM mensajes WHERE tipo= 'Sistema'");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}