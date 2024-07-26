<?php
include 'config.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = trim($_POST['nom']);
    $postnom = trim($_POST['postnom']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $birth_date = trim($_POST['birth_date']);

    if (empty($nom)) {
        $errors['nom'] = "Le nom est requis.";
    }

    if (empty($postnom)) {
        $errors['postnom'] = "Le postnom est requis.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email est invalide.";
    }

    if (empty($password) || strlen($password) < 6) {
        $errors['password'] = "Le mot de passe doit contenir au moins 6 caractères.";
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Les mots de passe ne correspondent pas.";
    }

    if (empty($birth_date)) {
        $errors['birth_date'] = "La date de naissance est requise.";
    } elseif (!DateTime::createFromFormat('Y-m-d', $birth_date)) {
        $errors['birth_date'] = "La date de naissance n'est pas valide. Utilisez le format AAAA-MM-JJ.";
    }

    if (empty($errors)) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (nom, postnom, email, password, user_type, birth_date) VALUES (?, ?, ?, ?, 'student', ?)");
        if ($stmt->execute([$nom, $postnom, $email, $passwordHash, $birth_date])) {
            // Redirection vers la page login.php après une inscription réussie
            header('Location: login.php');
            exit();
        } else {
            $errors['database'] = "Une erreur est survenue lors de l'inscription.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Smartschool</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<style>
    body {
    background-color: #f8f9fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: #ffffff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
}

h2 {
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1rem;
}

.btn-primary {
    width: 100%;
    padding: 0.75rem;
    font-size: 1.1rem;
}

</style>

<body>
    <div class="container">
        <h2 class="text-center">S'Inscrire</h2>
        <?php if ($success): ?>
            <div class="alert alert-success text-center">
                Inscription réussie ! Vous allez être redirigé vers la page de connexion.
            </div>
        <?php else: ?>
            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($nom ?? '', ENT_QUOTES); ?>">
                    <span class="text-danger"><?php echo $errors['nom'] ?? ''; ?></span>
                </div>
                <div class="form-group">
                    <label for="postnom">Postnom</label>
                    <input type="text" class="form-control" id="postnom" name="postnom" value="<?php echo htmlspecialchars($postnom ?? '', ENT_QUOTES); ?>">
                    <span class="text-danger"><?php echo $errors['postnom'] ?? ''; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES); ?>">
                    <span class="text-danger"><?php echo $errors['email'] ?? ''; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <span class="text-danger"><?php echo $errors['password'] ?? ''; ?></span>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                    <span class="text-danger"><?php echo $errors['confirm_password'] ?? ''; ?></span>
                </div>
                <div class="form-group">
                    <label for="birth_date">Date de naissance</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo htmlspecialchars($birth_date ?? '', ENT_QUOTES); ?>">
                    <span class="text-danger"><?php echo $errors['birth_date'] ?? ''; ?></span>
                </div>
                <button type="submit" class="btn btn-primary">Soumettre</button>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
