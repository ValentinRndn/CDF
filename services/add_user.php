<?php
include 'navbar.php'; // Inclut la navbar au début de la page
include 'db.php'; // Inclut la connexion à la base de données
// Récupère le rôle de l'utilisateur connecté
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="../style/add_user.css">
<head>
    <title>Ajouter un utilisateur</title>
</head>
<body>
    <h1>Ajouter un utilisateur</h1>
    <form action="process_add_user.php" id="addUserForm" method="POST">
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="wanted">Wanted :</label>
            <select id="wanted" name="wanted" required>
                <option value="0">Innocent</option>
                <option value="1">Traqué</option>
            </select><br><br>

        <label for="status">Status :</label>
        <input type="text" id="status" name="status" required><br><br>

        <label for="corpo">Corpo :</label>
        <input type="text" id="corpo" name="corpo" required><br><br>

        <label for="divers">Divers :</label>
        <input type="text" id="divers" name="divers" required><br><br>

        <?php if ($role === 'admin'): ?>
            <!-- Si l'utilisateur est admin, il peut choisir le rôle -->
            <label for="role">Rôle :</label>
            <select id="role" name="role" required>
                <option value="player">Player</option>
                <option value="admin">Admin</option>
            </select><br><br>
        <?php else: ?>
            <!-- Si l'utilisateur est joueur, le rôle est fixé par défaut sur 'player' -->
            <input type="hidden" name="role" value="player">
        <?php endif; ?>

        <button type="submit">Ajouter l'utilisateur</button>
    </form>
</body>
</html>
<script>
    document.getElementById('addUserForm').addEventListener('submit', function() {
        alert('Utilisateur créé avec succès.');
    });
</script>

<?php include 'footer.php'; ?>
