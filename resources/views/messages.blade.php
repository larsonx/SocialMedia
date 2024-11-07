<x-app-layout>
       <!-- resources/views/chat.blade.php -->
<div id="chat">
    <ul id="messages"></ul>
    <input type="text" id="message" placeholder="Type a message...">
    <button onclick="sendMessage()">Send</button>
</div>

<script>
    function sendMessage() {
        const message = document.getElementById('message').value;
        axios.post('/send-message', {
            friend_id: friendId,
            message: message
        });
    }

    Echo.private('chat.' + friendId)
        .listen('MessageSent', (e) => {
            const messages = document.getElementById('messages');
            const messageElement = document.createElement('li');
            messageElement.textContent = e.chat.message;
            messages.appendChild(messageElement);
        });
</script>
    </main>
    <x-footer/>
</x-app-layout>
    </body>
</html>
