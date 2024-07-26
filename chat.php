<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$receiver_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($receiver_id <= 0) {
    die('Utilisateur non valide.');
}

// Obtenir les messages
$stmt = $pdo->prepare("SELECT * FROM messages WHERE (sender_id = :sender_id AND receiver_id = :receiver_id) OR (sender_id = :receiver_id AND receiver_id = :sender_id) ORDER BY timestamp");
$stmt->execute(['sender_id' => $_SESSION['user_id'], 'receiver_id' => $receiver_id]);
$messages = $stmt->fetchAll();

// Obtenir le nom de l'utilisateur
$stmt = $pdo->prepare("SELECT nom, postnom FROM users WHERE id = :id");
$stmt->execute(['id' => $receiver_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messagerie avec <?php echo htmlspecialchars($user['nom']) . ' ' . htmlspecialchars($user['postnom']); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .message.user {
            background-color: #d1e7dd;
            text-align: right;
        }
        .message.receiver {
            background-color: #e2e3e5;
            text-align: left;
        }
        .messages {
            height: 300px;
            overflow-y: auto;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .input-group {
            display: flex;
        }
        .input-group input {
            flex: 1;
            border-radius: 20px;
            border: 1px solid #ddd;
        }
        .input-group button {
            border-radius: 20px;
            border: none;
            background-color: #3b5998;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Messagerie avec <?php echo htmlspecialchars($user['nom']) . ' ' . htmlspecialchars($user['postnom']); ?></h2>
        <div class="messages" id="messages">
            <?php foreach ($messages as $message): ?>
                <div class="message <?php echo $message['sender_id'] == $_SESSION['user_id'] ? 'user' : 'receiver'; ?>">
                    <?php echo htmlspecialchars($message['message']); ?>
                    <br>
                    <small><?php echo $message['timestamp']; ?></small>
                </div>
            <?php endforeach; ?>
        </div>
        <form id="messageForm">
            <div class="input-group">
                <input type="text" id="message" placeholder="Écrire un message..." required>
                <input type="hidden" id="receiver_id" value="<?php echo $receiver_id; ?>">
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('messageForm');
        const messages = document.getElementById('messages');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const message = document.getElementById('message').value;
            const receiverId = document.getElementById('receiver_id').value;

            fetch('send_message.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'message': message,
                    'receiver_id': receiverId
                })
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('message').value = '';
                loadMessages();
            });
        });

        function loadMessages() {
            fetch('get_messages.php?user_id=' + <?php echo json_encode($receiver_id); ?>)
            .then(response => response.text())
            .then(data => {
                messages.innerHTML = data;
                messages.scrollTop = messages.scrollHeight;
            });
        }

        setInterval(loadMessages, 3000);
        loadMessages();
    </script>
</body>
</html>
