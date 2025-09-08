<?php

require_once '../app/models/Promotion.php';
require_once '../app/core/Database.php';

class PromotionDAO {
    
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function findAll() {
        $sql = "SELECT * FROM promotions ORDER BY annee DESC, nom";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute();
        
        $promotions = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $promotion = new Promotion();
            $promotion->setId($row['id']);
            $promotion->setNom($row['nom']);
            $promotion->setAnnee($row['annee']);
            $promotion->setDescription($row['description']);
            $promotion->setCreatedAt($row['created_at']);
            $promotions[] = $promotion;
        }
        
        return $promotions;
    }
    
    public function findById($id) {
        $sql = "SELECT * FROM promotions WHERE id = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute([$id]);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $promotion = new Promotion();
            $promotion->setId($row['id']);
            $promotion->setNom($row['nom']);
            $promotion->setAnnee($row['annee']);
            $promotion->setDescription($row['description']);
            $promotion->setCreatedAt($row['created_at']);
            return $promotion;
        }
        
        return null;
    }
    
    public function create(Promotion $promotion) {
        $sql = "INSERT INTO promotions (nom, annee, description) VALUES (?, ?, ?)";
        $stmt = $this->db->getPdo()->prepare($sql);
        
        return $stmt->execute([
            $promotion->getNom(),
            $promotion->getAnnee(),
            $promotion->getDescription()
        ]);
    }

    public function update(Promotion $promotion) {
        $sql = "UPDATE promotions SET nom = ?, annee = ?, description = ? WHERE id = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        
        return $stmt->execute([
            $promotion->getNom(),
            $promotion->getAnnee(),
            $promotion->getDescription(),
            $promotion->getId()
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM promotions WHERE id = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        
        return $stmt->execute([$id]);
    }

    public function countStudents($promotionId) {
        $sql = "SELECT COUNT(*) FROM students WHERE promotion_id = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute([$promotionId]);
        
        return $stmt->fetchColumn();
    }
    
    public function getStudents($promotionId) {
        $sql = "SELECT * FROM students WHERE promotion_id = ? ORDER BY nom, prenom";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute([$promotionId]);
        
        $students = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            require_once '../app/models/Student.php';
            $student = new Student();
            $student->setId($row['id']);
            $student->setNom($row['nom']);
            $student->setPrenom($row['prenom']);
            $student->setAge($row['age']);
            $student->setEmail($row['email']);
            $student->setPromotionId($row['promotion_id']);
            $students[] = $student;
        }
        
        return $students;
    }
}