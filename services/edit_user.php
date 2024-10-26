<?php
include 'navbar.php'; // Inclut la navbar au début de la page
include 'db.php'; // Connexion à la base de données

// Vérifie si l'utilisateur est connecté et est un admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}

// Récupère l'ID de l'utilisateur à éditer
$userId = $_GET['id'];

// Récupère les informations de l'utilisateur depuis la base de données
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Utilisateur non trouvé.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier l'utilisateur</title>
    <link rel="stylesheet" type="text/css" href="../style/edit_user.css">
</head>
<body>
            <!-- Formulaire séparé pour supprimer l'utilisateur -->
            <form action="delete_user.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
            <input type="hidden" name="id" value="<?php echo $userId; ?>">
            <button id="deleteButton" type="submit" style="">Supprimer l'utilisateur</button>
        </form>
    <div class="container">
        <h1>Modifier l'utilisateur</h1>
        <form action="process_edit_user.php" id="editUser" method="POST">
            <input type="hidden" name="id" value="<?php echo $userId; ?>">

            <label for="pseudo">ID de l'auteur :</label>
            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($user['author']); ?>" required><br><br>
            
            <label for="pseudo">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" value="<?php echo htmlspecialchars($user['pseudo']); ?>" required><br><br>

            <label for="password">Nouveau mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Laissez vide si inchangé"><br><br>

            <label for="wanted">Wanted :</label>
            <select id="wanted" name="wanted" required>
                <option value="0" <?php if ($user['wanted'] == 0) echo 'selected'; ?>>Innocent</option>
                <option value="1" <?php if ($user['wanted'] == 1) echo 'selected'; ?>>Traqué</option>
            </select><br><br>

            <label for="role">Rôle :</label>
            <select id="role" name="role" required>
                <option value="player" <?php if ($user['role'] === 'player') echo 'selected'; ?>>Player</option>
                <option value="admin" <?php if ($user['role'] === 'admin') echo 'selected'; ?>>Admin</option>
            </select><br><br>

            <label for="status">Status :</label>
            <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($user[ 'status']); ?>" required><br><br>

            <label for="corpo">Corpo :</label>
            <input type="text" id="corpo" name="corpo" value="<?php echo htmlspecialchars($user['corpo']); ?>" required><br><br>

            <label for="divers">Divers :</label>
            <input type="text" id="divers" name="divers" value="<?php echo htmlspecialchars($user['divers']); ?>" required><br><br>

            <label for="role">Rôle :</label>
            <select id="role" name="role" required>
                <option value="player" <?php if ($user['role'] === 'player') echo 'selected'; ?>>Player</option>
                <option value="admin" <?php if ($user['role'] === 'admin') echo 'selected'; ?>>Admin</option>
            </select><br><br>

            <label for="locker">Casier Judiciaire :</label>
            <textarea id="locker" name="locker" rows="10" cols="50"><?php echo htmlspecialchars($user['locker']); ?></textarea><br><br>

            <button id="updateButton" type="submit">Mettre à jour l'utilisateur</button>
        </form>


    </div>
</body>
</html>
<script>
    document.getElementById('editUser').addEventListener('submit', function() {
        alert('Utilisateur modifié avec succès.');
    });
</script>

<?php include 'footer.php'; ?>
