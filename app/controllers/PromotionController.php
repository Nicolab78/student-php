<?php

require_once '../app/models/Promotion.php';
require_once '../app/dao/PromotionDAO.php';

class PromotionController {
    
    private $promotionDAO;
    
    public function __construct() {
        $this->promotionDAO = new PromotionDAO();
    }

    public function index() {
        try {
            $promotions = $this->promotionDAO->findAll();
            include '../app/views/promotions/index.php';
        } catch (Exception $e) {
            $error = "Erreur lors du chargement des promotions : " . $e->getMessage();
            include '../app/views/error.php';
        }
    }

    public function create() {
        include '../app/views/promotions/create.php';
    }

    public function store() {
        try {
            $nom = $_POST['nom'] ?? '';
            $annee = $_POST['annee'] ?? 0;
            $description = $_POST['description'] ?? '';
            
            if (empty($nom) || $annee <= 0) {
                throw new Exception("Le nom et l'année sont requis");
            }
            
            $promotion = new Promotion($nom, $annee, $description);
            
            // Sauvegarder
            if ($this->promotionDAO->create($promotion)) {
                $message = "Promotion créée avec succès !";
                header('Location: ?page=promotions&message=' . urlencode($message));
                exit;
            } else {
                throw new Exception("Erreur lors de la création");
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
            include '../app/views/promotions/create.php';
        }
    }

    public function show($id) {
        try {
            $promotion = $this->promotionDAO->findById($id);
            if (!$promotion) {
                throw new Exception("Promotion non trouvée");
            }
            
            $students = $this->promotionDAO->getStudents($id);
            $studentCount = $this->promotionDAO->countStudents($id);
            
            include '../app/views/promotions/show.php';
        } catch (Exception $e) {
            $error = "Erreur : " . $e->getMessage();
            include '../app/views/error.php';
        }
    }

    public function edit($id) {
        try {
            $promotion = $this->promotionDAO->findById($id);
            if (!$promotion) {
                throw new Exception("Promotion non trouvée");
            }
            include '../app/views/promotions/edit.php';
        } catch (Exception $e) {
            $error = "Erreur : " . $e->getMessage();
            include '../app/views/error.php';
        }
    }

    public function update($id) {
        try {
            $promotion = $this->promotionDAO->findById($id);
            if (!$promotion) {
                throw new Exception("Promotion non trouvée");
            }
            
            $promotion->setNom($_POST['nom'] ?? '');
            $promotion->setAnnee($_POST['annee'] ?? 0);
            $promotion->setDescription($_POST['description'] ?? '');
            
            if (empty($promotion->getNom()) || $promotion->getAnnee() <= 0) {
                throw new Exception("Le nom et l'année sont requis");
            }
            
            if ($this->promotionDAO->update($promotion)) {
                $message = "Promotion modifiée avec succès !";
                header('Location: ?page=promotions&message=' . urlencode($message));
                exit;
            } else {
                throw new Exception("Erreur lors de la modification");
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
            include '../app/views/promotions/edit.php';
        }
    }
    
    public function delete($id) {
        try {
            $studentCount = $this->promotionDAO->countStudents($id);
            if ($studentCount > 0) {
                throw new Exception("Impossible de supprimer : cette promotion contient {$studentCount} étudiant(s)");
            }
            
            if ($this->promotionDAO->delete($id)) {
                $message = "Promotion supprimée avec succès !";
                header('Location: ?page=promotions&message=' . urlencode($message));
                exit;
            } else {
                throw new Exception("Erreur lors de la suppression");
            }
        } catch (Exception $e) {
            $error = "Erreur : " . $e->getMessage();
            include '../app/views/error.php';
        }
    }

    public function addStudent($promotionId) {
    try {
        $studentId = $_POST['student_id'] ?? '';
        
        if (empty($studentId)) {
            throw new Exception("Veuillez sélectionner un étudiant");
        }
        
        require_once '../app/dao/StudentDAO.php';
        $studentDAO = new StudentDAO();
        $student = $studentDAO->findById($studentId);
        
        if (!$student) {
            throw new Exception("Étudiant non trouvé");
        }
        
        $student->setPromotionId($promotionId);
        
        if ($studentDAO->update($student)) {
            $message = "Étudiant ajouté à la promotion avec succès !";
            header('Location: ?page=promotions&message=' . urlencode($message));
            exit;
        } else {
            throw new Exception("Erreur lors de l'ajout");
        }
        
    } catch (Exception $e) {
        $error = "Erreur : " . $e->getMessage();
        include '../app/views/error.php';
    }
}
}