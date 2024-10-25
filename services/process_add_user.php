<?php
session_start();
require 'db.php'; // Assurez-vous que le chemin vers 'db.php' est correct

// Vérifie si l'utilisateur est connecté et a les droits requis (admin)
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: ../login.html");
    exit();
}

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère les données du formulaire
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $role = isset($_POST['role']) ? $_POST['role'] : 'player'; // Définit par défaut 'player' si aucun rôle n'est fourni
    $status = $_POST['status'];
    $corpo = $_POST['corpo'];
    $divers = $_POST['divers'];

    // Hachage du mot de passe pour des raisons de sécurité
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Préparation de la requête SQL pour insérer l'utilisateur
    $stmt = $conn->prepare("INSERT INTO users (pseudo, password, role, status, corpo, divers) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    // Liaison des paramètres
    $stmt->bind_param("ssssss", $pseudo, $hashedPassword, $role, $status, $corpo, $divers);

    // Exécute la requête et vérifie si l'utilisateur a bien été ajouté
    if ($stmt->execute()) {
        echo "Utilisateur ajouté avec succès.";
        header("Location: view_users.php"); // Redirige vers la page des utilisateurs après ajout
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur : " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
