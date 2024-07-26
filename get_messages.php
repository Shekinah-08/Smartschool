<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo 'Utilisateur non connecté.';
    exit();
}

$receiver_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($receiver_id <= 0) {
    echo 'Utilisateur non valide.';
    exit();
}

// Obtenir les messages
$stmt = $pdo->prepare("SELECT * FROM messages WHERE (sender_id = :sender_id AND receiver_id = :receiver_id) OR (sender_id = :receiver_id AND receiver_id = :sender_id) ORDER BY timestamp");
$stmt->execute(['sender_id' => $_SESSION['user_id'], 'receiver_id' => $receiver_id]);
$messages = $stmt->fetchAll();

// Afficher les messages
foreach ($messages as $message) {
    $class = $message['sender_id'] == $_SESSION['user_id'] ? 'user' : 'receiver';
    echo '<div class="message ' . $class . '">' . htmlspecialchars($message['message']) . '<br><small>' . $message['timestamp'] . '</small></div>';
}
?>
