<?php 
require_once '../app/services/AuthManager.php';
$user = AuthManager::getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>

    <link rel="stylesheet" href="/assets/css/students/index.css">
    <link rel="stylesheet" href="/assets/css/navbar.css">
</head>
<body>

    <header>
        <h1>Liste des étudiants</h1>
        <?php include dirname(__DIR__, 3) . '/public/assets/layout/navbar.php'; ?>
        
        
    </header>

    <main>

    <p></p>

    <?php if (isset($_GET['message'])): ?>
            <div class="message">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>
        
        <?php if (empty($students)): ?>
            <p>Aucun étudiant trouvé.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Âge</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= $student->getId() ?></td>
                            <td><?= htmlspecialchars($student->getNom()) ?></td>
                            <td><?= htmlspecialchars($student->getPrenom()) ?></td>
                            <td><?= $student->getAge() ?></td>
                            <td><?= htmlspecialchars($student->getEmail()) ?></td>
                            <td>

                                <a href="?page=student-show&id=<?= $student->getId() ?>">Voir</a>

                                <?php if ($user->canAccess('student-edit')): ?>
                                <a href="?page=student-edit&id=<?= $student->getId() ?>">Modifier</a>
                                <?php endif; ?>

                                <?php if (AuthManager::isAdmin()): ?>
                                <a href="?page=student-delete&id=<?= $student->getId() ?>" 
                                   onclick="return confirm('Supprimer cet étudiant ?')">Supprimer</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <p><strong>Total :</strong> <?= count($students) ?> étudiant(s)</p>
        <?php endif; ?>
    </main>
    
    
</body>
</html> 
    
