<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations du Tuteur</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Informations du Tuteur</h2>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            $_SESSION['tutor_name'] = $_POST['tutor_name'];
            $_SESSION['tutor_postname'] = $_POST['tutor_postname'];
            $_SESSION['tutor_firstname'] = $_POST['tutor_firstname'];
            $_SESSION['tutor_profession'] = $_POST['tutor_profession'];

            header('Location: student_form.php');
            exit();
        }
        ?>

        <form action="tutor_form.php" method="POST">
            <div class="form-group">
                <label for="tutorName">Nom</label>
                <input type="text" class="form-control" id="tutorName" name="tutor_name" required>
            </div>
            <div class="form-group">
                <label for="tutorPostName">Postnom</label>
                <input type="text" class="form-control" id="tutorPostName" name="tutor_postname" required>
            </div>
            <div class="form-group">
                <label for="tutorFirstName">Prénom</label>
                <input type="text" class="form-control" id="tutorFirstName" name="tutor_firstname" required>
            </div>
            <div class="form-group">
                <label for="tutorProfession">Profession</label>
                <input type="text" class="form-control" id="tutorProfession" name="tutor_profession" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Suivant</button>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
