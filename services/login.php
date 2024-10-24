<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrId = $_POST['pseudo'];
    $password = $_POST['password'];

    // Préparation de la requête SQL pour chercher par ID ou par pseudo
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE pseudo = ? OR id = ?");
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    $stmt->bind_param("si", $usernameOrId, $usernameOrId);
    $stmt->execute();
    $stmt->store_result();
    
    // Vérifie si un utilisateur existe avec cet identifiant ou ce pseudo
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $hashedPassword, $role);
        $stmt->fetch();
        
        // Vérifie si le mot de passe est correct
        if (password_verify($password, $hashedPassword)) {
            // Stocke l'ID et le rôle de l'utilisateur dans la session
            $_SESSION['user_id'] = $userId;
            $_SESSION['role'] = $role;
            header("Location: view_users.php"); // Redirige vers une page sécurisée
            exit();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet identifiant ou pseudo.";
    }
    $stmt->close();
}
$conn->close();
?>
