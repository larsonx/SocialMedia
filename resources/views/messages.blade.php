<!-- resources/views/messages.blade.php -->
<x-app-layout>
    <main class="container mx-auto mt-10">
        <div class="flex">
            <div class="bg-white p-6 shadow-lg rounded-md w-1/4">
                <ul>
                    <li><a href="/home" class="font-bold">Home</a></li>
                    <li><a href="/profiel" class="font-bold">Profile</a></li>
                    <li><a href="/friends" class="font-bold">Friends</a></li>
                    <li><a href="/messages" class="font-bold">Messages</a></li>
                </ul>
            </div>
            <div class="bg-white p-6 shadow-lg rounded-md w-1/4 mx-4">
                <h2 class="text-xl font-bold text-center">Friends List</h2>
                <ul id="friends-list">
                    @foreach($friends as $friend)
                        <li>
                            <a href="#" class="friend-link" data-friend-id="{{ $friend->id }}">{{ $friend->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="bg-white p-6 shadow-lg rounded-md w-1/2 mx-4">
                <h2 class="text-xl font-bold text-center">Chat</h2>
                <div id="chat-box" class="border p-4 h-64 overflow-y-scroll">
                    <!-- Chat messages will be appended here -->
                </div>
                <form id="chat-form" class="mt-4">
                    <input type="hidden" id="friend-id" name="friend_id">
                    <textarea id="message" name="message" class="w-full border rounded p-2" rows="3" placeholder="Type your message..."></textarea>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Send</button>
                </form>
            </div>
        </div>
    </main>
    <x-footer/>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const friendsList = document.getElementById('friends-list');
        const chatBox = document.getElementById('chat-box');
        const chatForm = document.getElementById('chat-form');
        const friendIdInput = document.getElementById('friend-id');
        const messageInput = document.getElementById('message');

        friendsList.addEventListener('click', function (e) {
            if (e.target.classList.contains('friend-link')) {
                e.preventDefault();
                const friendId = e.target.getAttribute('data-friend-id');
                friendIdInput.value = friendId;
                chatBox.innerHTML = ''; // Clear chat box
                // Load chat history with the selected friend (you need to implement this)
                loadChatHistory(friendId);
            }
        });

        chatForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const friendId = friendIdInput.value;
            const message = messageInput.value;

            if (friendId && message) {
                // Send message to the server (you need to implement this)
                sendMessage(friendId, message);
                messageInput.value = ''; // Clear message input
            }
        });

        function loadChatHistory(friendId) {
            // Implement AJAX request to load chat history with the selected friend
            // Append chat messages to chatBox
        }

        function sendMessage(friendId, message) {
            // Implement AJAX request to send message to the server
            // Append the sent message to chatBox
        }
    });
</script>