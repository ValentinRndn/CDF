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
<link rel="stylesheet" type="text/css" href="../style/navbar.css">
<div class="navbar">
    <img src="../assets/logo_cdf.png" alt="logo_cdf">
    <a href="view_users.php">Voir tous les utilisateurs</a>

        <a href="add_user.php">Ajouter un utilisateur</a>

    <a href="logout.php">Deconnexion</a>
</div>

<style>
</style>
