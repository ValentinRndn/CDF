<?php
include 'navbar.php'; // Inclut la navbar au début de la page
include 'db.php'; // Inclut la connexion à la base de données
// Récupère le rôle de l'utilisateur connecté
$role = $_SESSION['role'];

// Récupère le terme de recherche s'il est défini
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Préparation de la requête SQL pour filtrer les utilisateurs en fonction du terme de recherche
$sql = "SELECT * FROM users WHERE pseudo LIKE ? OR corpo LIKE ? OR id LIKE ? OR status LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $search . "%";
$stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="../style/views_users.css">
<head>
    <title>Liste des utilisateurs</title>
    <style>


    </style>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <form method="GET" action="view_users.php">
        <input type="text" name="search" placeholder="Rechercher par pseudo, corpo, ID ou status" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Rechercher</button>
    </form>
    <br>

    <table>
        <thead>
            <tr>
            <?php if ($role === 'admin'): ?>

                <th>ID</th>

                <?php endif; ?>
                <th>PSEUDO</th>
                <th>ROLE</th>
                <th>RECHERCHÉ</th>
                <th>STATUT</th>
                <th>CORPORATION</th>
                <th>DIVERS</th>
                <?php if ($role === 'admin'): ?>
                <th>DATE DE CRÉATION</th>
                <?php endif; ?>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                <?php if ($role === 'admin'): ?>

                    <td><?php echo $row['id']; ?></td>
                    <?php endif; ?>
                    <td><?php echo $row['pseudo']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td id="<?php echo $row['wanted'] ? 'status-mechant' : 'status-gentil'; ?>">
                    <?php echo $row['wanted'] ? 'Traqué' : 'Innocent'; ?>
                    </td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['corpo']; ?></td>
                    <td><?php echo $row['divers']; ?></td>
                    <?php if ($role === 'admin'): ?>
                    <td><?php echo $row['created_at']; ?></td>
                    <?php endif; ?>
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
<?php include 'footer.php'; ?>