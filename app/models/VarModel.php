<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class VarModel extends Model
{
    public function getVar($nombre): array
    {
        $stmt = $this->db->prepare("SELECT token FROM variables WHERE nombre = :nombre");
        $stmt->execute([':nombre' => $nombre]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}