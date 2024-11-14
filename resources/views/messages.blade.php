<x-app-layout>
    <div class="flex items-center mt-4 justify-center">
        <div class="bg-white p-6 shadow-lg rounded-md w-1/5 h-96 mx-4 hidden md:block">
            <h2 class="flex justify-center text-xl">Navigation</h2>
            <hr class="border-gray-300 my-4 border-t-2">
            <ul class="text-xl">
                <li><a href="/dashboard" class="hover:text-blue-500">Home</a></li>
                <li><a href="/profile" class="hover:text-blue-500">Profile</a></li>
                <li><a href="/friends" class="hover:text-blue-500">Friends</a></li>
                <li><a href="/messages" class="hover:text-blue-500">Messages</a></li>
            </ul>
        </div>
    
        <!-- Main Content -->
        <div class="flex flex-col h-96 w-full md:w-4/5 bg-white p-6 shadow-lg rounded-md mx-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold">Friends List</h2>
            </div>
      
            <!-- Friends List -->
            <div class="flex items-left mt-4 justify-start">
                <div class="flex flex-col h-auto">
                    <ul id="friends-list">
                        @foreach($users as $user)
                        @php
                            $friendship = Auth::user()->friends()->where('friend_id', $user->id)->first();
                            $reverseFriendship = Auth::user()->friendsFrom()->where('user_id', $user->id)->first();
                        @endphp
                        
                        @if (($friendship && $friendship->pivot->accepted) || ($reverseFriendship && $reverseFriendship->pivot->accepted))
                            <div class="flex items-center space-x-4">
                                <!-- Profile Image -->
                                <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-gray-300">
                                    <img src="{{ asset('images/' . $user->image) }}" alt="Profile Image" class="w-full h-full object-cover"/>
                                </div>
                                
                                <!-- User Information -->
                                <div class="flex flex-col">
                                    <p class="text-md font-semibold">
                                        <a href="#" class="friend-link" data-friend-id="{{ $user->id }}">{{ $user->name }}</a>
                                    </p>
                                    <p class="text-green-600 text-sm">Friend</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chat Box -->
    <div class="flex items-center mt-4 justify-center">
        <div class="flex flex-col w-full bg-white p-6 shadow-lg rounded-md mx-4 h-auto">
            <h2 class="text-lg font-bold mb-4">Chat</h2>
            
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
                // Load chat history with the selected friend
                loadChatHistory(friendId);
            }
        });

        chatForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const friendId = friendIdInput.value;
            const message = messageInput.value;

            if (friendId && message) {
                // Send message to the server
                sendMessage(friendId, message);
                messageInput.value = ''; // Clear message input
            }
        });

        function loadChatHistory(friendId) {
            axios.get(`/chat-history/${friendId}`)
                .then(response => {
                    const messages = response.data;
                    messages.forEach(message => {
                        const messageElement = document.createElement('div');
                        messageElement.innerHTML = `<strong>${message.user}</strong>: ${message.message} <br><small>${message.created_at}</small>`;
                        chatBox.appendChild(messageElement);
                    });
                })
                .catch(error => {
                    console.error('Error loading chat history:', error);
                });
        }

        function sendMessage(friendId, message) {
            axios.post('/send-message', {
                friend_id: friendId,
                message: message
            })
            .then(response => {
                const messageElement = document.createElement('div');
                messageElement.innerHTML = `<strong>${response.data.user}</strong>: ${response.data.message} <br><small>${response.data.created_at}</small>`;
                chatBox.appendChild(messageElement);
                chatBox.scrollTop = chatBox.scrollHeight; // Scroll to the bottom
            })
            .catch(error => {
                console.error('Error sending message:', error);
            });
        }

        // Initialize Pusher
        Pusher.logToConsole = true;

        const pusher = new Pusher('YOUR_PUSHER_APP_KEY', {
            cluster: 'YOUR_PUSHER_APP_CLUSTER',
            encrypted: true
        });

        const channel = pusher.subscribe('chat');
        channel.bind('message', function(data) {
            const messageElement = document.createElement('div');
            messageElement.innerHTML = `<strong>${data.user}</strong>: ${data.message} <br><small>${data.created_at}</small>`;
            chatBox.appendChild(messageElement);
            chatBox.scrollTop = chatBox.scrollHeight; // Scroll to the bottom
        });
    });
</script>