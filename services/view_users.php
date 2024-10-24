<?php
include 'navbar.php'; // Inclut la navbar au début de la page
include 'db.php'; // Inclut la connexion à la base de données

// Récupère le rôle de l'utilisateur connecté
$role = $_SESSION['role'];

// Récupération de tous les utilisateurs
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pseudo</th>
                <th>Role</th>
                <th>Status</th>
                <th>Corpo</th>
                <th>Divers</th>
                <th>Date de création</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['pseudo']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['corpo']; ?></td>
                    <td><?php echo $row['divers']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <?php if ($role === 'admin'): ?>
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>">Modifier</a>
                        <?php elseif ($role === 'player'): ?>
                            <a href="view_user.php?id=<?php echo $row['id']; ?>">Voir</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
