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

    
        
    default:
        echo "Page non trouvée";
        break;
}