<?php
require_once __DIR__ . '/../../core/Model.php';

class varModel extends Model
{
    public function getVar(): array
    {
        $stmt = $this->db->prepare("SELECT nombre,token FROM variables");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}