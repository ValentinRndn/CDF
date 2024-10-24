<?php
session_start();
require 'db.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

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
</head>
<body>
    <h1>Informations de l'utilisateur</h1>
    <p><strong>Pseudo :</strong> <?php echo $user['pseudo']; ?></p>
    <p><strong>Role :</strong> <?php echo $user['role']; ?></p>
    <p><strong>Status :</strong> <?php echo $user['status']; ?></p>
    <p><strong>Corpo :</strong> <?php echo $user['corpo']; ?></p>
    <p><strong>Divers :</strong> <?php echo $user['divers']; ?></p>
    <p><strong>Date de création :</strong> <?php echo $user['created_at']; ?></p>
</body>
</html>
