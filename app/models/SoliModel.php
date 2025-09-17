<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class SoliModel extends Model
{
    public function getSoli(): array{
        $stmt = $this->db->prepare("SELECT id, cliente , celular , fecha FROM solicitud WHERE estado = 1");
        $stmt->execute();
        return ["data" => $stmt->fetchAll(PDO::FETCH_ASSOC)];
    }

    public function saveSoli(array $data): array{

        $checkStmt = $this->db->prepare("SELECT COUNT(*) FROM solicitud WHERE celular = :celular");
        $checkStmt->execute([':celular' => $data['celular']]);
        $exists = $checkStmt->fetchColumn();

        if ($exists > 0) {
            return ['status' => 409];
        }

        $stmt = $this->db->prepare("INSERT INTO solicitud (cliente, celular , fecha, estado) VALUES (:cliente, :celular, :fecha, :estado)");
        $success = $stmt->execute([
            ':cliente' => $data['cliente'],
            ':celular' => $data['celular'],
            ':fecha' => $data['fecha'],
            ':estado' => $data['estado']
        ]);
        return $success ? ['status' => 200] : ['status' => 401];
    }

    public function updateSoli(array $data): array{
        $stmt = $this->db->prepare("UPDATE solicitud SET estado = :estado WHERE id = :id");
        $success = $stmt->execute([
            ':estado' => $data['estado'],
            ':id' => (int)$data['idSoli']
        ]);
        return $success ? ['status' => 200] : ['status' => 401];
    }
}
