<?php
session_start();
require 'db.php'; // Assurez-vous que le chemin vers 'db.php' est correct

// Débogage: Affiche les variables de session pour voir si elles sont bien définies
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

// Vérifie si l'utilisateur est connecté et est un admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Utilisateur non autorisé ou non connecté.";
    exit();
}

// Vérifie si le formulaire a été soumis avec l'ID de l'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $userId = $_POST['id'];

    // Préparation de la requête SQL pour supprimer l'utilisateur
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    $stmt->bind_param("i", $userId);

    // Exécute la requête et vérifie si l'utilisateur a bien été supprimé
    if ($stmt->execute()) {
        header("Location: view_users.php"); // Redirige vers la liste des utilisateurs après suppression
        exit();
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Requête non valide ou ID manquant.";
}
$conn->close();
?>
