<!DOCTYPE html>
<html>
<head>
    <title>Chatbot con Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Chat con Dialogflow</h2>
    <input type="text" id="user-input" placeholder="Escribe algo...">
    <button onclick="sendMessage()">Enviar</button>

    <div id="chat-response"></div>

    <script>
        async function sendMessage() {
            const message = document.getElementById('user-input').value;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await fetch('/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ message })
            });

            if (!response.ok) {
            const errorText = await response.text();
            console.error('Error:', errorText); // esto mostrará el HTML del error
            return;
            }

            const data = await response.json();
            console.log(data);
            document.getElementById('chat-response').innerText = 'Bot: ' + data.message;
        }
    </script>
</body>
</html>
