<?php

class Database {
    private $pdo;
    
    public function __construct() {
        // Charger les variables d'environnement
        $this->loadEnv();
        
        try {
            $dsn = "pgsql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_NAME'];
            $this->pdo = new PDO(
                $dsn,
                $_ENV['DB_USER'], 
                $_ENV['DB_PASSWORD']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur connexion : " . $e->getMessage());
        }
    }
    
    private function loadEnv() {
        $envFile = '../config/.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos($line, '#') === 0) continue;
                list($key, $value) = explode('=', $line, 2);
                $_ENV[trim($key)] = trim($value);
            }
        }
    }
    
    public function getPdo() {
        return $this->pdo;
    }
}