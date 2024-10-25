<?php
include 'navbar.php'; // Inclut la navbar au début de la page
include 'db.php'; // Inclut la connexion à la base de données

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

// Récupère le rôle de l'utilisateur connecté
$role = $_SESSION['role'];

// Récupère l'ID de l'utilisateur à afficher
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
    <title>Voir l'utilisateur</title>
    <link rel="stylesheet" type="text/css" href="../style/view_user.css">
</head>
<body>
    <div class="info-container">
        <h1>Informations de l'utilisateur</h1>
        <p><strong>Pseudo :</strong> <?php echo $user['pseudo']; ?></p>
        <p><strong>Role :</strong> <?php echo $user['role']; ?></p>
        <p><strong>Status :</strong> <?php echo $user['status']; ?></p>
        <p><strong>Corpo :</strong> <?php echo $user['corpo']; ?></p>
        <p><strong>Divers :</strong> <?php echo $user['divers']; ?></p>
        <p><strong>Date de création :</strong> <?php echo $user['created_at']; ?></p>

        <h2>Casier Judiciaire</h2>
        <form action="update_locker.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $userId; ?>">
            <!-- Affiche les informations existantes, mais les joueurs peuvent écrire en dessous -->
            <textarea name="locker" rows="10" cols="50" placeholder="Ajoutez des informations ici"><?php if ($role === 'admin') echo htmlspecialchars($user['locker']); ?></textarea><br><br>
            <?php if ($role === 'admin' || $role === 'player'): ?>
                <button type="submit">Mettre à jour le casier judiciaire</button>
            <?php endif; ?>
        </form>
        <?php if ($role === 'player'): ?>
            <p style="margin-top: 20px;">Les informations existantes : </p>
            <pre style="background-color: #1B2B48; padding: 10px; border-radius: 4px;"><?php echo htmlspecialchars($user['locker']); ?></pre>
        <?php endif; ?>
    </div>
</body>
</html>
