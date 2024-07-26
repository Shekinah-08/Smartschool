<?php
// Inclure le fichier d'en-tête
include 'header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos de SmartSchool</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h1, h2 {
            color: #007bff;
        }

        .about-section {
            margin-bottom: 30px;
        }

        .about-section img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .team-member {
            margin-bottom: 20px;
        }

        .team-member img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .team-member h4 {
            margin-top: 10px;
            color: #007bff;
        }

        .team-member p {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>À propos de SmartSchool</h1>

        <div class="about-section">
            <h2>Notre Mission</h2>
            <p>Chez SmartSchool, notre mission est d'offrir une éducation de qualité aux jeunes élèves de l'école primaire. Nous nous engageons à fournir un environnement d'apprentissage stimulant, sécurisé et inclusif pour tous nos élèves.</p>
        </div>

        <div class="about-section">
            <h2>Notre Histoire</h2>
            <p>SmartSchool a été fondée en 2023 avec l'objectif de transformer l'éducation primaire grâce à des méthodes innovantes et des technologies de pointe. Depuis notre ouverture, nous avons travaillé sans relâche pour créer une communauté d'apprentissage dynamique et encourageante.</p>
        </div>

        <div class="about-section">
            <h2>Notre Équipe</h2>
            <div class="row">
                <div class="col-md-4 team-member">
                    <img src="images/shekinah.jpg" alt="">
                    <h4>shekinah mukela</h4>
                    <p>Developpeur backend-end</p>
                </div>
                <div class="col-md-4 team-member">
                    <img src="path/.jpg" alt="">
                    <h4>Toussaint malolo</h4>
                    <p>Expert en edition de text</p>
                </div>
                <div class="col-md-4 team-member">
                    <img src="path/to/teacher3.jpg" alt="">
                    <h4>Gauthier Mwania</h4>
                    <p>Full stack Developpeur</p>
                </div>
            </div>
        </div>
        
        <div class="about-section">
            <h2>Contactez-Nous</h2>
            <p>Pour toute question ou information supplémentaire, n'hésitez pas à nous contacter à l'adresse suivante : <a href="mailto:contact@smartschool.com">contact@smartschool.com</a></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
