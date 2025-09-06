<?php 
require '../app/core/Database.php';

$page = $_GET['page'] ?? 'home';

$db = new Database();
echo "Connexion OK !";

switch ($page) {
    case 'home':
        include '../app/views/home.php';
        break;
        
    case 'students':
        echo "Liste des étudiants";
        break;
        
    default:
        echo "Page non trouvée";
        break;
}