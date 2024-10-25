<?php
$mot_de_passe = "1234";
$mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Affiche le mot de passe haché
echo $mot_de_passe_hash;
?>
