<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Étudiant</title>
    <link rel="stylesheet" href="/assets/css/students/create.css">
    <link rel="stylesheet" href="/assets/css/navbar.css">
</head>
<body>
    <header>
        <h1>Modifier l'Étudiant</h1>
        <?php include dirname(__DIR__, 3) . '/public/assets/layout/navbar.php'; ?>
    </header>
    
    <main>
        
        
        <?php if (isset($error)): ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="?page=student-update&id=<?= $student->getId() ?>">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required 
                       value="<?= htmlspecialchars($_POST['nom'] ?? $student->getNom()) ?>">
            </div>
            
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required 
                       value="<?= htmlspecialchars($_POST['prenom'] ?? $student->getPrenom()) ?>">
            </div>
            
            <div class="form-group">
                <label for="age">Âge :</label>
                <input type="number" id="age" name="age" min="1" max="120" required 
                       value="<?= htmlspecialchars($_POST['age'] ?? $student->getAge()) ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" 
                       value="<?= htmlspecialchars($_POST['email'] ?? $student->getEmail()) ?>">
            </div>
            
            <button type="submit">Modifier l'étudiant</button>
        </form>
    </main>
    
    <footer>
        <p>&copy; 2024 - Gestion Étudiants</p>
    </footer>
</body>
</html>