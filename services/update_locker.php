<?php
session_start();
require 'db.php'; // Connexion à la base de données

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

// Récupère le rôle de l'utilisateur connecté
$role = $_SESSION['role'];

// Récupère l'ID de l'utilisateur à mettre à jour
$userId = $_POST['id'];
$newLockerEntry = trim($_POST['locker']);

// Récupère les informations actuelles de l'utilisateur
$stmt = $conn->prepare("SELECT locker FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Utilisateur non trouvé.");
}

// Mise à jour du champ "locker"
if ($role === 'admin') {
    // L'admin peut modifier directement le texte existant
    $updatedLocker = $newLockerEntry;
} else {
    // Le joueur ne peut qu'ajouter du texte à la fin des entrées existantes
    $updatedLocker = $user['locker'] . "\n" . $newLockerEntry;
}

// Préparation de la requête SQL pour mettre à jour le champ "locker"
$updateStmt = $conn->prepare("UPDATE users SET locker = ? WHERE id = ?");
$updateStmt->bind_param("si", $updatedLocker, $userId);

if ($updateStmt->execute()) {
    header("Location: view_user.php?id=" . $userId);
    exit();
} else {
    echo "Erreur lors de la mise à jour du casier judiciaire : " . $updateStmt->error;
}

$updateStmt->close();
$conn->close();
?>
