<?php
session_start();
include 'config.php'; // Assurez-vous que ce fichier contient les bonnes informations de connexion

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    // Préparer et exécuter la requête pour récupérer les informations de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        throw new Exception('Utilisateur non trouvé.');
    }
} catch (PDOException $e) {
    $error = 'Erreur de la base de données : ' . $e->getMessage();
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de l'utilisateur</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Couleur de fond pour la page */
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
            margin-bottom: 50px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info h5 {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Mon Profil</h1>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="text-center">
            <?php if (!empty($user['profile_picture'])): ?>
                <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Photo de profil" class="profile-img">
            <?php else: ?>
                <img src="uploads/default.png" alt="Photo de profil" class="profile-img">
            <?php endif; ?>
        </div>

        <div class="profile-info">
            <h5>Prénom</h5>
            <p><?php echo isset($user['first_name']) ? htmlspecialchars($user['first_name']) : 'Non défini'; ?></p>
        </div>

        <div class="profile-info">
            <h5>Nom</h5>
            <p><?php echo isset($user['last_name']) ? htmlspecialchars($user['last_name']) : 'Non défini'; ?></p>
        </div>

        <div class="profile-info">
            <h5>Email</h5>
            <p><?php echo isset($user['email_address']) ? htmlspecialchars($user['email_address']) : 'Non défini'; ?></p>
        </div>

        <div class="profile-info">
            <h5>Date de naissance</h5>
            <p><?php echo isset($user['birth_date']) ? htmlspecialchars($user['birth_date']) : 'Non défini'; ?></p>
        </div>

        <a href="update_profil.php" class="btn btn-primary">Modifier le profil</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
