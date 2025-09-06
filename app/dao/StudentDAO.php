<?php

require_once '../app/models/Student.php';
require_once '../app/core/Database.php';

class StudentDAO {
    
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }

    public function findAll() {
        $sql = "SELECT * FROM students ORDER BY nom, prenom";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute();
        
        $students = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $student = new Student();
            $student->setId($row['id']);
            $student->setNom($row['nom']);
            $student->setPrenom($row['prenom']);
            $student->setAge($row['age']);
            $student->setEmail($row['email']);
            $students[] = $student;
        }
        
        return $students;
    }

    public function findById($id) {
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        $stmt->execute([$id]);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $student = new Student();
            $student->setId($row['id']);
            $student->setNom($row['nom']);
            $student->setPrenom($row['prenom']);
            $student->setAge($row['age']);
            $student->setEmail($row['email']);
            return $student;
        }
        
        return null;
    }

    public function create(Student $student) {
        $sql = "INSERT INTO students (nom, prenom, age, email) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->getPdo()->prepare($sql);
        
        return $stmt->execute([
            $student->getNom(),
            $student->getPrenom(),
            $student->getAge(),
            $student->getEmail()
        ]);
    }

    public function update(Student $student) {
        $sql = "UPDATE students SET nom = ?, prenom = ?, age = ?, email = ? WHERE id = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        
        return $stmt->execute([
            $student->getNom(),
            $student->getPrenom(),
            $student->getAge(),
            $student->getEmail(),
            $student->getId()
        ]);
    }
    
    public function delete($id) {
        $sql = "DELETE FROM students WHERE id = ?";
        $stmt = $this->db->getPdo()->prepare($sql);
        
        return $stmt->execute([$id]);
    }
}