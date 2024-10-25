<?php
session_start();
require 'db.php'; // Assurez-vous que le chemin vers 'db.php' est correct

// Vérifie si l'utilisateur est connecté et est un admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.html");
    exit();
}

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère les données du formulaire
    $userId = $_POST['id'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $corpo = $_POST['corpo'];
    $divers = $_POST['divers'];
    $locker = $_POST['locker'];

    // Prépare la mise à jour du mot de passe si un nouveau mot de passe est défini
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE users SET pseudo = ?, password = ?, role = ?, status = ?, corpo = ?, divers = ?, locker = ? WHERE id = ?");
        if ($stmt === false) {
            die("Erreur de préparation de la requête : " . $conn->error);
        }
        $stmt->bind_param("sssssssi", $pseudo, $hashedPassword, $role, $status, $corpo, $divers, $locker, $userId);
    } else {
        // Si aucun mot de passe n'est fourni, ne met pas à jour ce champ
        $stmt = $conn->prepare("UPDATE users SET pseudo = ?, role = ?, status = ?, corpo = ?, divers = ?, locker = ? WHERE id = ?");
        if ($stmt === false) {
            die("Erreur de préparation de la requête : " . $conn->error);
        }
        $stmt->bind_param("ssssssi", $pseudo, $role, $status, $corpo, $divers, $locker, $userId);
    }

    // Exécute la requête et vérifie si elle a réussi
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
