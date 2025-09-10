<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Promotions</title>
    <link rel="stylesheet" href="/assets/css/promotions/index.css">
    <link rel="stylesheet" href="/assets/css/navbar.css">
</head>
<body>
    <header>
        <h1>Liste des Promotions</h1>
        <?php include dirname(__DIR__, 3) . '/public/assets/layout/navbar.php'; ?>
    </header>
    
    <main>

        
        <?php if (isset($_GET['message'])): ?>
            <div class="message">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>
        
        <?php if (empty($promotions)): ?>
            <p>Aucune promotion trouvée.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Année</th>
                        <th>Description</th>
                        <th>Étudiants</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($promotions as $promotion): ?>
                        <tr>
                            <td><?= $promotion->getId() ?></td>
                            <td><?= htmlspecialchars($promotion->getNom()) ?></td>
                            <td><?= $promotion->getAnnee() ?></td>
                            <td><?= htmlspecialchars($promotion->getDescription()) ?></td>
                            <td>
                                <?php 
                                $promotionDAO = new PromotionDAO();
                                $count = $promotionDAO->countStudents($promotion->getId());
                                echo $count . ' étudiant(s)';
                                ?>
                            </td>
                            <td>
                                <a href="?page=promotion-show&id=<?= $promotion->getId() ?>">Voir</a>

                                <?php if ($user->canAccess('promotion-edit')): ?>
                                <a href="?page=promotion-edit&id=<?= $promotion->getId() ?>">Modifier</a>
                                <?php endif; ?>

                                <?php if (AuthManager::isAdmin()): ?>
                                <a href="?page=promotion-delete&id=<?= $promotion->getId() ?>" 
                                   onclick="return confirm('Supprimer cette promotion ?')">Supprimer</a>
                                <?php endif; ?>
                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <p><strong>Total :</strong> <?= count($promotions) ?> promotion(s)</p>
        <?php endif; ?>
    </main>
    
    <footer>
        <p>&copy; 2024 - Gestion Étudiants</p>
    </footer>
</body>
</html>