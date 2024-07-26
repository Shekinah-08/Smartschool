<?php
require 'config.php'; // Inclure la configuration de la base de données

$query = $_GET['query'] ?? '';

if ($query) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM items WHERE name LIKE :query");
        $stmt->bindValue(':query', "%$query%");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = "Erreur lors de la recherche : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de Recherche</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Résultats de Recherche pour "<?php echo htmlspecialchars($query); ?>"</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if (!empty($results)): ?>
            <ul>
                <?php foreach ($results as $item): ?>
                    <li><?php echo htmlspecialchars($item['name']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun résultat trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>
