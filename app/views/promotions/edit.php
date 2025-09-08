<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Promotion</title>
    <link rel="stylesheet" href="/assets/css/promotions/edit.css">
    <link rel="stylesheet" href="/assets/css/navbar.css">
</head>
<body>
    <header>
        <h1>Modifier la Promotion</h1>
        <?php include dirname(__DIR__, 3) . '/public/assets/layout/navbar.php'; ?>
    </header>
    
    <main>
        
        
        <?php if (isset($error)): ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="?page=promotion-update&id=<?= $promotion->getId() ?>">
            <div class="form-group">
                <label for="nom">Nom de la promotion :</label>
                <input type="text" id="nom" name="nom" required 
                       value="<?= htmlspecialchars($_POST['nom'] ?? $promotion->getNom()) ?>">
            </div>
            
            <div class="form-group">
                <label for="annee">Année :</label>
                <input type="number" id="annee" name="annee" min="2020" max="2030" required 
                       value="<?= htmlspecialchars($_POST['annee'] ?? $promotion->getAnnee()) ?>">
            </div>
            
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" rows="4" cols="50"><?= htmlspecialchars($_POST['description'] ?? $promotion->getDescription()) ?></textarea>
            </div>
            
            <button type="submit">Modifier la promotion</button>
        </form>
    </main>
    
    <footer>
        <p>&copy; 2024 - Gestion Étudiants</p>
    </footer>
</body>
</html>