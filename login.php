<?php
session_start();
include 'config.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données

// Variables pour les messages d'erreur
$error = '';

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifiez si les champs du formulaire sont remplis
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            // Préparez et exécutez la requête pour obtenir les informations de l'utilisateur
            $stmt = $pdo->prepare('SELECT id, password, user_type FROM users WHERE email = :email');
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifiez si l'utilisateur existe et si le mot de passe est correct
            if ($user && password_verify($password, $user['password'])) {
                // Démarrez la session et redirigez vers la page appropriée en fonction du type d'utilisateur
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_type'] = $user['user_type'];

                // Redirection en fonction du type d'utilisateur
                switch ($user['user_type']) {
                    case 'admin':
                        header('Location: admin.php');
                        break;
                    case 'student':
                        header('Location: index.php');
                        break;
                    case 'teacher':
                        header('Location: teacher.php');
                        break;
                    default:
                        $error = "Type d'utilisateur inconnu.";
                        break;
                }
                exit();
            } else {
                $error = "Identifiants incorrects.";
            }
        } catch (PDOException $e) {
            $error = "Erreur lors de la connexion : " . $e->getMessage();
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Administration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .login-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center; /* Centre le texte et les éléments à l'intérieur */
        }
        .login-form h2 {
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            width: 100%;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .register-link {
            display: block;
            margin-top: 15px;
            text-align: center;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h2>Connexion</h2>
            
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error, ENT_QUOTES); ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-custom">Se connecter</button>
            </form>
            <div class="register-link">
                <p>Vous n'avez pas de compte ? <a href="register.php">Inscrivez-vous ici</a></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
