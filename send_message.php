<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo 'Utilisateur non connecté.';
    exit();
}

$message = isset($_POST['message']) ? $_POST['message'] : '';
$receiver_id = isset($_POST['receiver_id']) ? intval($_POST['receiver_id']) : 0;

if (empty($message) || $receiver_id <= 0) {
    echo 'Données invalides.';
    exit();
}

// Insérer le message dans la base de données
$stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message, timestamp) VALUES (:sender_id, :receiver_id, :message, NOW())");
$stmt->execute(['sender_id' => $_SESSION['user_id'], 'receiver_id' => $receiver_id, 'message' => $message]);

echo 'Message envoyé.';
?>
