<?php 
require_once '../app/services/AuthManager.php';
$user = AuthManager::getCurrentUser();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'Étudiant</title>
    <link rel="stylesheet" href="/assets/css/students/create.css">
    <link rel="stylesheet" href="/assets/css/navbar.css">
</head>
<body>
    <header>
        <h1>Détails de l'Étudiant</h1>
        <?php include dirname(__DIR__, 3) . '/public/assets/layout/navbar.php'; ?>
    </header>
    
    <main>
        
        
        <div class="student-info">
            
            <p><strong>ID :</strong> <?= $student->getId() ?></p>
            <p><strong>Nom :</strong> <?= htmlspecialchars($student->getNom()) ?></p>
            <p><strong>Prénom :</strong> <?= htmlspecialchars($student->getPrenom()) ?></p>
            <p><strong>Âge :</strong> <?= $student->getAge() ?> ans</p>
            <p><strong>Email :</strong> 
                <?php if ($student->getEmail()): ?>
                    <a href="mailto:<?= htmlspecialchars($student->getEmail()) ?>">
                        <?= htmlspecialchars($student->getEmail()) ?>
                    </a>
                <?php else: ?>
                    Non renseigné
                <?php endif; ?>
            </p>
        </div>
        
        <div class="actions">
            <?php if ($user->canAccess('student-edit')): ?>
            <a href="?page=student-edit&id=<?= $student->getId() ?>">Modifier</a>
            <?php endif; ?>

            <?php if (AuthManager::isAdmin()): ?>
            <a href="?page=student-delete&id=<?= $student->getId() ?>" 
               onclick="return confirm('Supprimer cet étudiant ?')">Supprimer</a>
            <?php endif; ?>
        </div>
    </main>
    
    <footer>
        <p>&copy; 2024 - Gestion Étudiants</p>
    </footer>
</body>
</html>