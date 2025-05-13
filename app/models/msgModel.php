<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class msgModel extends Model
{
    public function getMsgGuest(): array{
        $stmt = $this->db->prepare("SELECT mensaje as msgGuest FROM mensajes WHERE tipo= 'Sistema'");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}