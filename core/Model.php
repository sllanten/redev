<?php

namespace App\Core;

use PDO;
use PDOException;
class Model
{
    protected $db;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/config.php';
        try {
            $this->db = new PDO(
                'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'],
                $config['db']['user'],
                $config['db']['pass']
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log(date('[Y-m-d H:i:s] ') . "DB Connection Error: " . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../logs/conex.log');
            die('Database connection failed.');
        }
    }
}
