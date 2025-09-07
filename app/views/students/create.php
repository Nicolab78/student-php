<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Étudiant</title>
    <link rel="stylesheet" href="/assets/css/students/create.css">
    <link rel="stylesheet" href="/assets/css/navbar.css">
</head>
<body>
    <header>
        <h1>Ajouter un Étudiant</h1>
        <?php include dirname(__DIR__, 3) . '/public/assets/layout/navbar.php'; ?>
    </header>
    
    <main>
        <nav>
            <ul>
                <li><a href="?page=students">Retour à la liste</a></li>
            </ul>
        </nav>
        
        <?php if (isset($error)): ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="?page=student-store">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required 
                       value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required 
                       value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="age">Âge :</label>
                <input type="number" id="age" name="age" min="1" max="120" required 
                       value="<?= htmlspecialchars($_POST['age'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" 
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>
            
            <button type="submit">Créer l'étudiant</button>
        </form>
    </main>
    
    <footer>
        <p>&copy; 2024 - Gestion Étudiants</p>
    </footer>
</body>
</html>