<?php 
require_once '../app/services/AuthManager.php';
$user = AuthManager::getCurrentUser();
?>

<nav>
    <ul>
        <li><a href="?page=home">Accueil</a></li>
        <li><a href="?page=students">Liste des étudiants</a></li>
        
        <?php if ($user->canAccess('student-create')): ?>
            <li><a href="?page=student-create">Ajouter un étudiant</a></li>
        <?php endif; ?>
        
        <li><a href="?page=promotions">Promotions</a></li>
        
        <?php if (AuthManager::isAdmin()): ?>
            <li><a href="?page=promotion-create">Ajouter une promotion</a></li>
        <?php endif; ?>
        
        <li><a href="?page=logout">Se déconnecter</a></li>
        <li>
            Connecté : <strong><?= $user->getUsername() ?></strong> (<?= $user->getRole() ?>)
        </li>
    </ul>
</nav>