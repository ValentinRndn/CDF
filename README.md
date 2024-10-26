# CDF PANEL (https://cdf-panel.com/)

Bienvenue dans **CDF PANEL**, une application qui répertorie tous les joueurs d'un jeu avec leurs infos complémentaires. Il s'agit d'une application à but communautaire, elle est alimentée par les joueurs eux-mêmes.

## Fonctionnalités

- **Authentification utilisateur** : Permet aux utilisateurs de se connecter et d'accéder aux fonctionnalités en fonction de leur rôle.
- **Gestion des rôles** : L'application distingue plusieurs rôles comme "admin", "utilisateur", offrant des accès et privilèges différents.
- **Affichage dynamique des données** : Les utilisateurs peuvent voir les informations relatives aux membres, les statuts d'alliance (allié, ennemi, etc.), et les détails spécifiques.
- **Interface interactive** : Barre de navigation, tableau dynamique avec couleurs alternées, et liens d'action conditionnels.

## Structure du Projet

- **public_html/** : Contient les fichiers accessibles publiquement, y compris la page d'accueil, les styles CSS, et les scripts.
  - `login.html` : Page de connexion pour accéder à l'application.
- **services/** : Contient les services de backend, tels que l'authentification et la gestion des utilisateurs.
  - `db.php` : Fichier de configuration de la base de données pour gérer la connexion.
  - `login.php` : Script de traitement de la connexion utilisateur.
  - `logout.php` : Script de déconnexion de l'utilisateur.
  - `autres fichiers` : Tous les scripts nécessaires au CRUD de l'application
- **style/** : Dossier des styles CSS pour les différentes parties de l'application.

- **assets/** : Contient les fichiers statiques, comme les images et les logos.

## Prérequis

Avant de démarrer l'application, assurez-vous d'avoir les éléments suivants installés et configurés :

- PHP 7+ pour exécuter les scripts de backend.
- MySQL pour la base de données.
- Serveur web (Apache, Nginx, ou un serveur local comme XAMPP).

