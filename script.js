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
    fetch('get_messages.php?user_id=' + <?php echo json_encode($receiver_id); 
    ?>)
    .then(response => response.text())
    .then(data => {
        messages.innerHTML = data;
        messages.scrollTop = messages.scrollHeight;
    });
}

setInterval(loadMessages, 3000);
loadMessages();
