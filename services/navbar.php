<?php
session_start();

// Vérifie si l'utilisateur est connecté et a le rôle requis
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

// Récupère le rôle de l'utilisateur
$role = $_SESSION['role'];
?>

<div class="navbar">
    <a href="dashboard.php">Dashboard</a>
        <a href="add_user.php">Ajouter un utilisateur</a>
        <a href="view_users.php">Voir tous les utilisateurs</a>

    <a href="logout.php">Déconnexion</a>
</div>

<style>
    /* Style de base pour la navbar */
    .navbar {
        background-color: #333;
        overflow: hidden;
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
    }

    .navbar a {
        color: white;
        text-decoration: none;
        padding: 14px 20px;
        display: block;
    }

    .navbar a:hover {
        background-color: #575757;
    }
</style>
