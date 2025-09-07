<?php 
require_once '../app/core/Database.php';
require_once '../app/controllers/StudentController.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        include '../app/views/home.php';
        break;

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
    
    default:
        echo "Page non trouvée";
        break;
}