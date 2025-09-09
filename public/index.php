<?php
session_start();

require_once '../app/core/Database.php';
require_once '../app/controllers/StudentController.php';
require_once '../app/controllers/PromotionController.php';
require_once '../app/controllers/AuthController.php';

$page = $_GET['page'] ?? 'home';

$publicPages = ['login', 'authenticate', 'register', 'handleRegister'];

if (!AuthManager::isLoggedIn() && !in_array($page, $publicPages)) {
    header('Location: ?page=login');
    exit;
}
switch ($page) {
    case 'home':
        include '../app/views/home.php';
        break;
        
    // Routes d'authentification
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
        
    case 'authenticate':
        $controller = new AuthController();
        $controller->authenticate();
        break;
        
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
        
    case 'unauthorized':
        $controller = new AuthController();
        $controller->unauthorized();
        break;

     case 'register':
        $controller = new AuthController();
        $controller->register();
        break;

    case 'handleRegister':
        $controller = new AuthController();
        $controller->handleRegister();
        break;   
        
    // Routes étudiants
    case 'students':
        $controller = new StudentController();
        $controller->index();
        break;
        
    case 'student-create':
        $controller = new StudentController();
        $controller->create();
        break;
        
    case 'student-store':
        $controller = new StudentController();
        $controller->store();
        break;
        
    case 'student-show':
        $controller = new StudentController();
        $controller->show($_GET['id']);
        break;
        
    case 'student-edit':
        $controller = new StudentController();
        $controller->edit($_GET['id']);
        break;
        
    case 'student-update':
        $controller = new StudentController();
        $controller->update($_GET['id']);
        break;
        
    case 'student-delete':
        $controller = new StudentController();
        $controller->delete($_GET['id']);
        break;
        
    // Routes promotions
    case 'promotions':
        $controller = new PromotionController();
        $controller->index();
        break;
        
    case 'promotion-create':
        $controller = new PromotionController();
        $controller->create();
        break;
        
    case 'promotion-store':
        $controller = new PromotionController();
        $controller->store();
        break;
        
    case 'promotion-show':
        $controller = new PromotionController();
        $controller->show($_GET['id']);
        break;
        
    case 'promotion-edit':
        $controller = new PromotionController();
        $controller->edit($_GET['id']);
        break;
        
    case 'promotion-update':
        $controller = new PromotionController();
        $controller->update($_GET['id']);
        break;
        
    case 'promotion-delete':
        $controller = new PromotionController();
        $controller->delete($_GET['id']);
        break;
        
    case 'promotion-add-student':
        $controller = new PromotionController();
        $controller->addStudent($_GET['id']);
        break;
        
    default:
        echo "Page non trouvée";
        break;
}