<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Aide</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .chatbox {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .message.user {
            background-color: #d1e7dd;
            text-align: right;
        }
        .message.bot {
            background-color: #e2e3e5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="chatbox">
            <div class="messages" id="messages">
                <!-- Les messages du chatbot seront affichés ici -->
            </div>
            <div class="input-group">
                <input type="text" id="userInput" placeholder="Posez une question...">
                <button class="btn" onclick="sendMessage()">Envoyer</button>
            </div>
        </div>
    </div>   

    <script>
        const responses = {
            "qui est le créateur de ce site ?": " Le site a été créé par groupe les informacien, un groupe d'experts en informatique et en éducation.",
            "comment puis-je inscrire mon enfant ?": "Vous pouvez vous inscrire en visitant la page <a href='tutor_form.php'>d'inscription</a>.",
            "comment puis-je contacter l'école ?": "Vous pouvez contacter l'école par téléphone au 0831450523 ou par email à shekinahmkl@gmail.com Vous pouvez également visiter notre bureau situé à [Adresse Physique]. ",
            "quand commence l'année scolaire": "L'année scolaire commence généralement le 13 septembre, mais cela peut varier. Veuillez consulter le calendrier académique sur notre site ou contacter l'école pour des informations précises. ",
            "y a-t-il des activités parascolaires proposées ?": "Oui, l'école propose diverses activités parascolaires telles que le sport, la musique, et les clubs académiques. Vous pouvez en savoir plus sur les activités disponibles sur la page [Activités Parascolaires] ou demander des détails lors de l'inscription. ",
            "comment puis-je suivre la progression académique de mon enfant ?": "Vous pouvez suivre la progression académique de votre enfant en accédant à notre portail en ligne pour les parents ou en contactant directement les enseignants. Plus de détails sont disponibles sur la page [Suivi Académique].",
            "quelles sont les horaires de l'école ?": "Les horaires de l'école sont généralement de 8H30 à 12H30, du lundi au vendredi. Pour les horaires spécifiques de chaque niveau, veuillez consulter notre site ou contacter l'école. ",
        };

        function sendMessage() {
            const input = document.getElementById('userInput');
            const message = input.value.trim().toLowerCase();
            if (message) {
                displayMessage(message, 'user');
                const response = responses[message] || "Je n'ai pas compris votre question.";
                displayMessage(response, 'bot');
                input.value = '';
                document.getElementById('messages').scrollTop = document.getElementById('messages').scrollHeight;
            }
        }

        function displayMessage(message, sender) {
            const messageElement = document.createElement('div');
            messageElement.className = `message ${sender}`;
            messageElement.innerHTML = message;
            document.getElementById('messages').appendChild(messageElement);
        }
    </script>
</body>
</html>
