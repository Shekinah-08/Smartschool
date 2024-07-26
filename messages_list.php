<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Récupérer la liste des utilisateurs
$stmt = $pdo->query("SELECT id, nom, postnom FROM users WHERE id != " . $_SESSION['user_id']);
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Liste des Utilisateurs</h2>
        <ul class="list-group">
            <?php foreach ($users as $user): ?>
                <li class="list-group-item">
                    <a href="chat.php?user_id=<?php echo $user['id']; ?>">
                        <?php echo htmlspecialchars($user['nom']) . ' ' . htmlspecialchars($user['postnom']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
