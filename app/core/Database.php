<?php

class Database {
    private $pdo;
    
    public function __construct() {
        $config = require '../config/database.php';
        
        try {
            $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['database']}";
            $this->pdo = new PDO(
                $dsn,
                $config['username'], 
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die("Erreur connexion : " . $e->getMessage());
        }
    }
    
    public function getPdo() {
        return $this->pdo;
    }
}