<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En-tête</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #4267B2; 
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            color: #fff;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 40px;
        }

        .form-inline {
            flex: 1;
            display: flex;
            justify-content: center;
            margin: 0 20px;
        }

        .form-inline input {
            width: 40%;
            padding: 8px;
            border: none;
            border-radius: 20px 0 0 20px;
            outline: none;
        }

        .form-inline button {
            padding: 8px 16px;
            border: none;
            border-radius: 0 20px 20px 0;
            background-color: #fff;
            color: #4267B2;
            cursor: pointer;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-item {
            display: flex;
            align-items: center;
        }

        .nav-item a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .nav-item a i {
            margin-right: 8px;
        }

        .nav-item a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .form-inline input {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="index.php">
            <img src="images/R.jfif" alt="Logo">
        </a>
        <form class="form-inline" action="recherche.php" method="get">
            <input type="search" name="query" placeholder="Rechercher" aria-label="Rechercher">
            <button type="submit">Rechercher</button>
        </form>
        <div class="navbar-nav">
            <div class="nav-item">
                <a href="index.php"><i class="fas fa-home"></i>Accueil</a>
            </div>
            <div class="nav-item">
                <a href="aide.php"><i class="fas fa-question-circle"></i>Aide</a>
            </div>
            <div class="nav-item">
                <a href="profil.php"><i class="fas fa-user"></i>Mon Profil</a>
            </div>
            <div class="nav-item">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
            </div>
        </div>
    </nav>
</body>
</html>
