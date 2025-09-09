<?php

require_once '../app/core/Database.php';

class UserDAO {
    
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }

    public function create($userData) {
        $sql = "INSERT INTO users (username, email, password_hash, role, assigned_promotion_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->getPdo()->prepare($sql);
        
        return $stmt->execute([
            $userData['username'],
            $userData['email'],
            $userData['password_hash'],
            $userData['role'],
            $userData['assigned_promotion_id'] ?? null
        ]);
    }

    public function findByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute([$username]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute([$email]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute([$id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findAll() {
        $sql = "SELECT * FROM users ORDER BY username";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function findByRole($role) {
        $sql = "SELECT * FROM users WHERE role = ? ORDER BY username";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute([$role]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findTeachersByPromotion($promotionId) {
        $sql = "SELECT * FROM users WHERE role = 'teacher' AND assigned_promotion_id = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute([$promotionId]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $userData) {
        $sql = "UPDATE users SET username = ?, email = ?, role = ?, assigned_promotion_id = ? WHERE id = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        
        return $stmt->execute([
            $userData['username'],
            $userData['email'],
            $userData['role'],
            $userData['assigned_promotion_id'] ?? null,
            $id
        ]);
    }

    public function assignTeacherToPromotion($teacherId, $promotionId) {
        $sql = "UPDATE users SET assigned_promotion_id = ? WHERE id = ? AND role = 'teacher'";
        $stmt = $this->db->getPdo()->prepare($sql);
        
        return $stmt->execute([$promotionId, $teacherId]);
    }

    public function unassignTeacher($teacherId) {
        $sql = "UPDATE users SET assigned_promotion_id = NULL WHERE id = ? AND role = 'teacher'";
        $stmt = $this->db->getPdo()->prepare($sql);
        
        return $stmt->execute([$teacherId]);
    }

    public function updatePassword($id, $newPasswordHash) {
        $sql = "UPDATE users SET password_hash = ? WHERE id = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        
        return $stmt->execute([$newPasswordHash, $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        
        return $stmt->execute([$id]);
    }

    public function usernameExists($username, $excludeId = null) {
        $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
        $params = [$username];
        
        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchColumn() > 0;
    }
    
    public function emailExists($email, $excludeId = null) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
        $params = [$email];
        
        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchColumn() > 0;
    }

    public function countByRole($role) {
        $sql = "SELECT COUNT(*) FROM users WHERE role = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute([$role]);
        
        return $stmt->fetchColumn();
    }
}