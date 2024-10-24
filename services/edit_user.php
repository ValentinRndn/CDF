<?php
include 'navbar.php'; // Inclut la navbar au début de la page
include 'db.php'; // Inclut la connexion à la base de données
// Récupère l'ID de l'utilisateur à modifier
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
</head>
<body>
    <h1>Modifier l'utilisateur</h1>
    <form action="update_user.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" value="<?php echo $user['pseudo']; ?>" required><br><br>

        <label for="password">Nouveau mot de passe :</label>
        <input type="password" id="password" name="password"><br><br>

        <label for="role">Rôle :</label>
        <select id="role" name="role" required>
            <option value="player" <?php if ($user['role'] === 'player') echo 'selected'; ?>>Player</option>
            <option value="admin" <?php if ($user['role'] === 'admin') echo 'selected'; ?>>Admin</option>
        </select><br><br>

        <label for="status">Status :</label>
        <input type="text" id="status" name="status" value="<?php echo $user['status']; ?>" required><br><br>

        <label for="corpo">Corpo :</label>
        <input type="text" id="corpo" name="corpo" value="<?php echo $user['corpo']; ?>" required><br><br>

        <label for="divers">Divers :</label>
        <input type="text" id="divers" name="divers" value="<?php echo $user['divers']; ?>" required><br><br>

        <button type="submit">Mettre à jour l'utilisateur</button>
    </form>
</body>
</html>
