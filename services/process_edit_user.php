<?php
session_start(); // Démarre la session

require 'db.php'; // Assurez-vous que le chemin vers 'db.php' est correct

// Vérifie si l'utilisateur est connecté et est un admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.html");
    exit();
}

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $corpo = $_POST['corpo'];
    $divers = $_POST['divers'];
    $locker = $_POST['locker'];
    $wanted = $_POST['wanted'];

    // Hachage du mot de passe si un nouveau mot de passe est défini
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE users SET pseudo = ?, password = ?, role = ?, status = ?, corpo = ?, divers = ?, locker = ?, wanted = ? WHERE id = ?");
        $stmt->bind_param("sssssssii", $pseudo, $hashedPassword, $role, $status, $corpo, $divers, $locker, $wanted, $userId);
    } else {
        $stmt = $conn->prepare("UPDATE users SET pseudo = ?, role = ?, status = ?, corpo = ?, divers = ?, locker = ?, wanted = ? WHERE id = ?");
        $stmt->bind_param("ssssssii", $pseudo, $role, $status, $corpo, $divers, $locker, $wanted, $userId);
    }

    if ($stmt->execute()) {
        header("Location: view_users.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
