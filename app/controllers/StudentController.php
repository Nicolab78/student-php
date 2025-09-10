<?php

require_once '../app/models/Student.php';
require_once '../app/dao/StudentDAO.php';
require_once '../app/services/AuthManager.php';

class StudentController {
    
    private $studentDAO;
    
    public function __construct() {
        $this->studentDAO = new StudentDAO();
    }

    public function index() {
        // Tous peuvent voir la liste
        try {
            $students = $this->studentDAO->findAll();
            include '../app/views/students/index.php';
        } catch (Exception $e) {
            $error = "Erreur lors du chargement des étudiants : " . $e->getMessage();
            include '../app/views/error.php';
        }
    }

    public function create() {
        // Seuls admin et teacher peuvent créer
        AuthManager::requireRoles(['admin', 'teacher']);
        include '../app/views/students/create.php';
    }

    public function store() {
        AuthManager::requireRoles(['admin', 'teacher']);
        try {
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $age = $_POST['age'] ?? 0;
            $email = $_POST['email'] ?? '';
            
            if (empty($nom) || empty($prenom) || $age <= 0) {
                throw new Exception("Tous les champs sont requis");
            }
            
            $student = new Student($nom, $prenom, $age, $email);
            
            if ($this->studentDAO->create($student)) {
                $message = "Étudiant créé avec succès !";
                header('Location: ?page=students&message=' . urlencode($message));
                exit;
            } else {
                throw new Exception("Erreur lors de la création");
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
            include '../app/views/students/create.php';
        }
    }
    
    public function show($id) {
        // Tous peuvent voir le détail
        try {
            $student = $this->studentDAO->findById($id);
            if (!$student) {
                throw new Exception("Étudiant non trouvé");
            }
            include '../app/views/students/show.php';
        } catch (Exception $e) {
            $error = "Erreur : " . $e->getMessage();
            include '../app/views/error.php';
        }
    }

    public function edit($id) {
        AuthManager::requireRoles(['admin', 'teacher']);
        try {
            $student = $this->studentDAO->findById($id);
            if (!$student) {
                throw new Exception("Étudiant non trouvé");
            }
            include '../app/views/students/edit.php';
        } catch (Exception $e) {
            $error = "Erreur : " . $e->getMessage();
            include '../app/views/error.php';
        }
    }

    public function update($id) {
        AuthManager::requireRoles(['admin', 'teacher']);
        try {
            $student = $this->studentDAO->findById($id);
            if (!$student) {
                throw new Exception("Étudiant non trouvé");
            }

            $student->setNom($_POST['nom'] ?? '');
            $student->setPrenom($_POST['prenom'] ?? '');
            $student->setAge($_POST['age'] ?? 0);
            $student->setEmail($_POST['email'] ?? '');
            
            if (empty($student->getNom()) || empty($student->getPrenom()) || $student->getAge() <= 0) {
                throw new Exception("Tous les champs sont requis");
            }
            
            if ($this->studentDAO->update($student)) {
                $message = "Étudiant modifié avec succès !";
                header('Location: ?page=students&message=' . urlencode($message));
                exit;
            } else {
                throw new Exception("Erreur lors de la modification");
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
            include '../app/views/students/edit.php';
        }
    }

    public function delete($id) {
        // Seul l'admin peut supprimer
        AuthManager::requireRole('admin');
        try {
            if ($this->studentDAO->delete($id)) {
                $message = "Étudiant supprimé avec succès !";
                header('Location: ?page=students&message=' . urlencode($message));
                exit;
            } else {
                throw new Exception("Erreur lors de la suppression");
            }
        } catch (Exception $e) {
            $error = "Erreur : " . $e->getMessage();
            include '../app/views/error.php';
        }
    }
}