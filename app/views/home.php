<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Étudiants - Accueil</title>
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/navbar.css">
</head>
<body>
    <header>
        <h1>Gestion des Étudiants</h1>
<?php include dirname(__DIR__, 2) . '/public/assets/layout/navbar.php'; ?>
    </header>
    
    <main>

        
        <p>Bienvenue dans l'application de gestion des étudiants</p>
                
        <section>
            <h2>Statistiques rapides</h2>
            <p>Nombre d'étudiants : <strong>0</strong></p>
            <p>Moyenne générale : <strong>-</strong></p>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 - Gestion Étudiants MVC</p>
    </footer>
</body>
</html>