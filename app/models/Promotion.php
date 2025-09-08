<?php

class Promotion {
    private $id;
    private $nom;
    private $annee;
    private $description;
    private $created_at;
    
    public function __construct($nom = '', $annee = 0, $description = '') {
        $this->nom = $nom;
        $this->annee = $annee;
        $this->description = $description;
    }
    
    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getNom() {
        return $this->nom;
    }
    
    public function getAnnee() {
        return $this->annee;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function getCreatedAt() {
        return $this->created_at;
    }
    
    // Setters
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setNom($nom) {
        $this->nom = $nom;
    }
    
    public function setAnnee($annee) {
        $this->annee = $annee;
    }
    
    public function setDescription($description) {
        $this->description = $description;
    }
    
    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
    
    // Méthodes utiles
    public function getFullName() {
        return $this->nom . ' (' . $this->annee . ')';
    }
    
    public function toArray() {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'annee' => $this->annee,
            'description' => $this->description,
            'created_at' => $this->created_at
        ];
    }
}