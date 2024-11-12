<x-app-layout>
    <div class="flex items-stretch justify-center mt-4">
        <!-- Friends List -->
        <div class="bg-white p-6 shadow-lg rounded-md w-1/4 mx-4">
            <h2 class="text-xl font-bold text-center">Friends</h2>
            <hr class="border-gray-300 my-4 border-t-2">

            <ul>
                @foreach ($friends as $friend)
                    <li>
                        <a href="#" 
                            class="block py-2 text-gray-800 hover:bg-gray-200 rounded" 
                            onclick="startChat({{ $friend->id }})">
                            {{ $friend->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Chat Area -->
        <div class="bg-white p-6 shadow-lg rounded-md w-3/4 mx-4">
            <h2 class="text-xl font-bold text-center">Chat with <span id="friendName"></span></h2>
            <hr class="border-gray-300 my-4 border-t-2">
            
            <div id="chat-box" class="h-96 overflow-y-auto mb-4 p-4 bg-gray-100 border rounded-md">
                <!-- Chat messages will appear here -->
            </div>

            <form id="message-form">
                <input type="hidden" id="friend-id">
                <textarea id="message" class="w-full p-2 border rounded-md" placeholder="Type a message..."></textarea>
                <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md">Send</button>
            </form>
        </div>
    </div>

    <x-footer />
</x-app-layout>

<script>
    let currentFriendId = null;
    let chatChannel = null;

    // Function to start a chat with a friend
    function startChat(friendId) {
        currentFriendId = friendId;
        document.getElementById('friend-id').value = friendId;

        // Set the friend's name in the chat header
        let friendName = document.querySelector(`#friend-${friendId} .friend-name`).textContent;
        document.getElementById('friendName').textContent = friendName;

        // Fetch chat history for the selected friend
        fetch(`/messages/${friendId}`)
            .then(response => response.json())
            .then(data => {
                const chatBox = document.getElementById('chat-box');
                chatBox.innerHTML = ''; // Clear existing chat
                data.messages.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('message');
                    messageElement.innerHTML = `<strong>${message.user.name}:</strong> ${message.message}`;
                    chatBox.appendChild(messageElement);
                });

                // Scroll to the bottom of the chat
                chatBox.scrollTop = chatBox.scrollHeight;

                // Join the chat channel
                if (chatChannel) {
                    chatChannel.leave();
                }
                chatChannel = Echo.private(`messages.${friendId}`)
                    .listen('MessageSent', (event) => {
                        if (event.chat.user.id !== currentFriendId) return;
                        const chatBox = document.getElementById('chat-box');
                        const newMessage = document.createElement('div');
                        newMessage.classList.add('message');
                        newMessage.innerHTML = `<strong>${event.chat.user.name}:</strong> ${event.chat.message}`;
                        chatBox.appendChild(newMessage);

                        // Scroll to the bottom of the chat
                        chatBox.scrollTop = chatBox.scrollHeight;
                    });
            });
    }

    // Send a message
    document.getElementById('message-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const message = document.getElementById('message').value;
        if (!message.trim()) return;

        const formData = new FormData();
        formData.append('friend_id', currentFriendId);
        formData.append('message', message);

        fetch('/send-message', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('message').value = ''; // Clear input
        });
    });
</script>
