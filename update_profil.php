<?php
session_start();
include 'config.php'; // Assurez-vous que ce fichier contient les bonnes informations de connexion

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

    // Gérer la soumission du formulaire de mise à jour
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $postnom = $_POST['postnom'];
        $email = $_POST['email'];
        $birth_date = $_POST['birth_date'];
        $errors = [];

        // Validation des données
        if (empty($name)) {
            $errors[] = 'Le nom est requis.';
        }

        if (empty($postnom)) {
            $errors[] = 'Le postnom est requis.';
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email invalide.';
        }

        if (empty($birth_date)) {
            $errors[] = 'La date de naissance est requise.';
        }

        if (empty($errors)) {
            // Mettre à jour les informations dans la base de données
            $stmt = $pdo->prepare("UPDATE users SET name = :name, postnom = :postnom, email = :email, birth_date = :birth_date WHERE id = :id");
            $stmt->execute([
                'name' => $name,
                'postnom' => $postnom,
                'email' => $email,
                'birth_date' => $birth_date,
                'id' => $user_id
            ]);
            $message = 'Informations mises à jour avec succès.';
        }
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
    <title>Mettre à jour le profil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 80px; /* Pour compenser la hauteur de la navbar fixe */
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Mettre à jour votre profil</h1>

        <?php if (!empty($message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="update_profil.php" method="post">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($user['name']) ? htmlspecialchars($user['name']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="postnom">Postnom</label>
                <input type="text" class="form-control" id="postnom" name="postnom" value="<?php echo isset($user['postnom']) ? htmlspecialchars($user['postnom']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($user['email']) ? htmlspecialchars($user['email']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="birth_date">Date de naissance</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo isset($user['birth_date']) ? htmlspecialchars($user['birth_date']) : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
