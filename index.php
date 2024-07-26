<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil smartschool</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            position: relative;
        }
        .content {
            padding-bottom: 100px; /* Hauteur approximative du footer */
        }
        .home-bg {
            background-image: url('images/image1.jpg');
            background-size: cover;
            background-position: center;
            height: 50vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black;
            text-align: center;
        }
        .category img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }
        .category img:hover {
            transform: scale(1.1);
        }
        .category-item {
            margin-bottom: 20px;
        }
        .activities {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="content">
        <?php include 'header.php'; ?>

        <div class="home-bg">
            <div>
                <h1>Bienvenue a smartschool</h1>
                <a href="tutor_form.php" class="btn btn-primary btn-lg">Inscrivez-vous maintenant</a>
            </div>
        </div>

        <div class="container my-5">
            <h2 class="text-center mb-4">Nos Catégories</h2>
            <div class="row">
                <div class="col-md-3 category-item">
                    <img src="images/image2.jpg" alt="Category 1" class="img-fluid">
                </div>
                <div class="col-md-3 category-item">
                    <img src="images/image3.jfif" alt="Category 2" class="img-fluid">
                </div>
                <div class="col-md-3 category-item">
                    <img src="images/OIP.jfif" alt="Category 3" class="img-fluid">
                </div>
                <div class="col-md-3 category-item">
                    <img src="images/OIP (3).jfif" alt="Category 4" class="img-fluid">
                </div>
            </div>
        </div>

        <div class="container activities">
            <h2 class="text-center mb-4">Autres Activités</h2>
            <?php
            // $activities = getActivitiesFromDatabase();
            // foreach ($activities as $activity) {
            //     echo '<p>' . $activity['description'] . '</p>';
            // }
            ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
