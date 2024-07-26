<?php
// Connexion à la base de données
include 'config.php';

// Vérification de la connexion utilisateur
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Compte d'éléments pour les statistiques (exemple)
try {
    $stmtStudents = $pdo->query('SELECT COUNT(*) AS total FROM students');
    $studentsCount = $stmtStudents->fetch(PDO::FETCH_ASSOC)['total'];

    $stmtClasses = $pdo->query('SELECT COUNT(*) AS total FROM classes');
    $classesCount = $stmtClasses->fetch(PDO::FETCH_ASSOC)['total'];

    $stmtFinances = $pdo->query('SELECT SUM(amount) AS total FROM payments');
    $financesTotal = $stmtFinances->fetch(PDO::FETCH_ASSOC)['total'];
} catch (PDOException $e) {
    $error = "Erreur lors de la récupération des données : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Administration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .admin-container {
            margin: 20px;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
        }
        .sidebar h2 {
            color: #ffffff;
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: #ffffff;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
            border-radius: 4px;
        }
        .main-content {
            margin-left: 270px;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-title {
            font-size: 1.25rem;
        }
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            border: none;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Administration</h2>
        <a href="users.php">Gestion des Utilisateurs</a>
        <a href="students.php">Gestion des Étudiants</a>
        <a href="classes.php">Gestion des Classes</a>
        <a href="teachers.php">Gestion des Enseignants</a>
        <a href="parents.php">Gestion des Parents</a>
        <a href="finance.php">Gestion des Finances</a>
        <a href="resources.php">Gestion des Ressources</a>
        <a href="events.php">Gestion des Activités</a>
        <a href="reports.php">Rapports et Statistiques</a>
        <a href="settings.php">Paramètres</a>
        <a href="#" id="logout" onclick="confirmLogout()">Déconnexion</a>
    </div>

    <div class="main-content">
        <div class="container">
            <h1 class="text-center">Tableau de Bord</h1>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error, ENT_QUOTES); ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistiques des Étudiants</h5>
                            <p class="card-text">Nombre total d'étudiants inscrits : <?php echo htmlspecialchars($studentsCount, ENT_QUOTES); ?></p>
                            <a href="students.php" class="btn btn-custom">Voir les Étudiants</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Gestion des Cours</h5>
                            <p class="card-text">Nombre total de classes : <?php echo htmlspecialchars($classesCount, ENT_QUOTES); ?></p>
                            <a href="classes.php" class="btn btn-custom">Voir les Classes</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Gestion des Finances</h5>
                            <p class="card-text">Total des paiements : <?php echo htmlspecialchars(number_format($financesTotal, 2), ENT_QUOTES); ?> €</p>
                            <a href="finance.php" class="btn btn-custom">Voir les Finances</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function confirmLogout() {
            if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
                window.location.href = 'logout.php';
            }
        }
    </script>
</body>
</html>











