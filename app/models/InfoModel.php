<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class InfoModel extends Model
{
    public function getSuscription($codigo): ?array{
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
            s.estado = 1 AND u.codigo = :codigo;
        ");
        $stmt->execute([':codigo' => $codigo]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            return [
                'status' => 200,
                'data' => $result
            ];
        } else {
            return [
                'status' => 403,
                'data' => []
            ];
        }

    }    
}
