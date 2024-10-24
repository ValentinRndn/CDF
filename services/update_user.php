<?php
session_start();
require 'db.php'; // Connexion à la base de données

// Vérifie si l'utilisateur est connecté et est un admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}

// Récupère les données du formulaire
$userId = $_POST['id'];
$pseudo = $_POST['pseudo'];
$password = $_POST['password'];
$role = $_POST['role'];
$status = $_POST['status'];
$corpo = $_POST['corpo'];
$divers = $_POST['divers'];

// Si un nouveau mot de passe est défini, on le hache
if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("UPDATE users SET pseudo = ?, password = ?, role = ?, status = ?, corpo = ?, divers = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $pseudo, $hashedPassword, $role, $status, $corpo, $divers, $userId);
} else {
    // Si aucun mot de passe n'est fourni, on ne met pas à jour ce champ
    $stmt = $conn->prepare("UPDATE users SET pseudo = ?, role = ?, status = ?, corpo = ?, divers = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $pseudo, $role, $status, $corpo, $divers, $userId);
}

// Exécute la requête et vérifie si elle a réussi
if ($stmt->execute()) {
    echo "Utilisateur mis à jour avec succès.";
    header("Location: view_users.php");
    exit();
} else {
    echo "Erreur lors de la mise à jour de l'utilisateur : " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
