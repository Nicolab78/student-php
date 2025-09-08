<?php

class Student {
    private $id;
    private $nom;
    private $prenom;
    private $age;
    private $email;

    private $promotion_id;
    
    public function __construct($nom = '', $prenom = '', $age = 0, $email = '' , $promotion_id = null) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->email = $email;
        $this->promotion_id = $promotion_id;

    }
    
    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getNom() {
        return $this->nom;
    }
    
    public function getPrenom() {
        return $this->prenom;
    }
    
    public function getAge() {
        return $this->age;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    // Setters
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setNom($nom) {
        $this->nom = $nom;
    }
    
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
    
    public function setAge($age) {
        $this->age = $age;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPromotionId() {
    return $this->promotion_id;
    }

    public function setPromotionId($promotion_id) {
    $this->promotion_id = $promotion_id;
    }
    
    public function getFullName() {
    return $this->prenom . ' ' . $this->nom;
}

    public function toArray() {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'age' => $this->age,
            'email' => $this->email
        ];
    }
}