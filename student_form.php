<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations de l'Élève</title>
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
        .form-section {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">

        <?php
        session_start();
        require 'config.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tutor_name = $_SESSION['tutor_name'];
            $tutor_postname = $_SESSION['tutor_postname'];
            $tutor_firstname = $_SESSION['tutor_firstname'];
            $tutor_profession = $_SESSION['tutor_profession'];

            $student_name = $_POST['student_name'];
            $student_postname = $_POST['student_postname'];
            $student_firstname = $_POST['student_firstname'];
            $gender = $_POST['gender'];
            $class = $_POST['class'];
            $previous_school = $_POST['previous_school'];

            // Gérer le téléchargement de la photo
            $photo = null;
            if (isset($_FILES['student_photo']) && $_FILES['student_photo']['error'] == UPLOAD_ERR_OK) {
                $photo = $_FILES['student_photo'];
                $photo_name = time() . '_' . basename($photo['name']);
                $photo_tmp_name = $photo['tmp_name'];
                $photo_path = 'uploads/' . $photo_name;

                // Créer le dossier uploads s'il n'existe pas
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                // Déplacer le fichier téléchargé dans le dossier uploads
                if (move_uploaded_file($photo_tmp_name, $photo_path)) {
                    // Photo enregistrée avec succès
                } else {
                    echo '<div class="alert alert-danger">Erreur lors du téléchargement de la photo.</div>';
                }
            }

            try {
                $sql = "INSERT INTO students (tutor_name, tutor_postname, tutor_firstname, tutor_profession, student_name, student_postname, student_firstname, gender, class, previous_school, photo)
                        VALUES (:tutor_name, :tutor_postname, :tutor_firstname, :tutor_profession, :student_name, :student_postname, :student_firstname, :gender, :class, :previous_school, :photo)";
                
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':tutor_name', $tutor_name);
                $stmt->bindParam(':tutor_postname', $tutor_postname);
                $stmt->bindParam(':tutor_firstname', $tutor_firstname);
                $stmt->bindParam(':tutor_profession', $tutor_profession);
                $stmt->bindParam(':student_name', $student_name);
                $stmt->bindParam(':student_postname', $student_postname);
                $stmt->bindParam(':student_firstname', $student_firstname);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':class', $class);
                $stmt->bindParam(':previous_school', $previous_school);
                $stmt->bindParam(':photo', $photo_name);

                if ($stmt->execute()) {
                    echo '<div class="alert alert-success">Inscription réussie!</div>';
                } else {
                    echo '<div class="alert alert-danger">Erreur lors de l\'inscription. Veuillez réessayer.</div>';
                }
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger">Erreur de connexion à la base de données : ' . $e->getMessage() . '</div>';
            }
        }
        ?>

        <form action="student_form.php" method="POST" enctype="multipart/form-data">
            <!-- Informations de l'Élève -->
            <div class="form-section">
                <h4>Informations de l'Élève</h4>
                <div class="form-group">
                    <label for="studentName">Nom eleve</label>
                    <input type="text" class="form-control" id="studentName" name="student_name" required>
                </div>
                <div class="form-group">
                    <label for="studentPostName">Postnom eleve</label>
                    <input type="text" class="form-control" id="studentPostName" name="student_postname" required>
                </div>
                <div class="form-group">
                    <label for="studentFirstName">Prénom eleve</label>
                    <input type="text" class="form-control" id="studentFirstName" name="student_firstname" required>
                </div>
                <div class="form-group">
                    <label for="gender">Sexe eleve</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="">Sélectionner</option>
                        <option value="Male">Masculin</option>
                        <option value="Female">Féminin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="class">Classe eleve</label>
                    <input type="text" class="form-control" id="class" name="class" required>
                </div>
                <div class="form-group">
                    <label for="previousSchool">École de provenance de l'eleve</label>
                    <input type="text" class="form-control" id="previousSchool" name="previous_school" required>
                </div>
            </div>

            <!-- Photo -->
            <div class="form-section">
                <h4>Photo de l'Élève</h4>
                <div class="form-group">
                    <label for="studentPhoto">Télécharger la photo</label>
                    <input type="file" class="form-control-file" id="studentPhoto" name="student_photo" accept="image/*">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Inscrire</button>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
