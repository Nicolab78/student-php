<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Promotion</title>
    <link rel="stylesheet" href="/assets/css/promotions/show.css">
    <link rel="stylesheet" href="/assets/css/navbar.css">
</head>
<body>
    <header>
        <h1>Détails de la Promotion</h1>
        <?php include dirname(__DIR__, 3) . '/public/assets/layout/navbar.php'; ?>
    </header>
    
    <main>
        <nav>
            <ul>
                <li><a href="?page=promotions">Retour à la liste</a></li>
            </ul>
        </nav>
        
        <div class="student-info">
            <h2><?= htmlspecialchars($promotion->getFullName()) ?></h2>
            
            <p><strong>ID :</strong> <?= $promotion->getId() ?></p>
            <p><strong>Nom :</strong> <?= htmlspecialchars($promotion->getNom()) ?></p>
            <p><strong>Année :</strong> <?= $promotion->getAnnee() ?></p>
            <p><strong>Description :</strong> 
                <?php if ($promotion->getDescription()): ?>
                    <?= htmlspecialchars($promotion->getDescription()) ?>
                <?php else: ?>
                    Non renseignée
                <?php endif; ?>
            </p>
            <p><strong>Nombre d'étudiants :</strong> <?= $studentCount ?></p>
        </div>
        
        <h3>Étudiants de cette promotion</h3>
        
        <?php if (empty($students)): ?>
            <p>Aucun étudiant dans cette promotion.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
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
                            <td><?= htmlspecialchars($student->getNom()) ?></td>
                            <td><?= htmlspecialchars($student->getPrenom()) ?></td>
                            <td><?= $student->getAge() ?> ans</td>
                            <td>
                                <?php if ($student->getEmail()): ?>
                                    <a href="mailto:<?= htmlspecialchars($student->getEmail()) ?>">
                                        <?= htmlspecialchars($student->getEmail()) ?>
                                    </a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="?page=student-show&id=<?= $student->getId() ?>">Voir</a>

                                <?php if ( $user->canAccess('promotion-edit') && $user->getPromotionId() === $promotion->getId()): ?>
                                <a href="?page=student-edit&id=<?= $student->getId() ?>">Modifier</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        
<?php if ($user->canAccess('promotion-edit')): ?>
    <h3>Ajouter un étudiant à cette promotion</h3>

    <form method="POST" action="?page=promotion-add-student&id=<?= $promotion->getId() ?>">
        <div class="form-group">
            <label for="student_id">Choisir un étudiant :</label>
            <select id="student_id" name="student_id" required>
                <option value="">-- Sélectionner un étudiant --</option>
                <?php 
                require_once '../app/dao/StudentDAO.php';
                $studentDAO = new StudentDAO();
                $allStudents = $studentDAO->findAll();
                
                foreach ($allStudents as $student): 
                    if ($student->getPromotionId() != $promotion->getId()):
                ?>
                    <option value="<?= $student->getId() ?>">
                        <?= htmlspecialchars($student->getFullName()) ?>
                        <?php if ($student->getPromotionId()): ?>
                            (déjà dans une autre promotion)
                        <?php else: ?>
                            (sans promotion)
                        <?php endif; ?>
                    </option>
                <?php 
                    endif;
                endforeach; 
                ?>
            </select>
        </div>
        <button type="submit">Ajouter à la promotion</button>
    </form>
<?php endif; ?>

        
        <div class="actions">

            <?php if ($user->canAccess('promotion-edit')): ?>
            <a href="?page=promotion-edit&id=<?= $promotion->getId() ?>">Modifier cette promotion</a>
            <?php endif; ?>

            <?php if (AuthManager::isAdmin()): ?>
            <a href="?page=promotion-delete&id=<?= $promotion->getId() ?>" 
               onclick="return confirm('Supprimer cette promotion ?')">Supprimer</a>
            <?php endif; ?>
        </div>
    </main>
    
    <footer>
        <p>&copy; 2024 - Gestion Étudiants</p>
    </footer>
</body>
</html>