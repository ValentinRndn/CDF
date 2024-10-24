
<?php
include 'navbar.php'; // Inclut la navbar au début de la page
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

</head>
<body>  
    <div class="container">
        <?php if ($role === 'admin'): ?>
            <h1>Dashboard Admin</h1>
            <p>Bienvenue, admin ! Utilisez la navbar pour naviguer.</p>
        <?php elseif ($role === 'player'): ?>
            <h1>Dashboard Joueur</h1>
            <p>Bienvenue sur votre espace personnel.</p>
            <!-- Contenu spécifique aux joueurs -->
            <a href="view_profile.php">Voir votre profil</a>
        <?php endif; ?>
    </div>
</body>
</html>
