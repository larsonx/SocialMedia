// resources/js/echo.js

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Initialize Echo with Pusher and environment variables
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,  // Make sure this is correct
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,  // Make sure this is correct
    forceTLS: true
});

// Assuming `friendId` is passed dynamically from the backend (e.g., Blade template)
let friendId = window.friendId;  // Ensure friendId is available here

// Listening for 'MessageSent' event on the private channel for a specific friend
Echo.private('messages.' + friendId)
    .listen('MessageSent', (event) => {
        console.log('New message:', event.chat);
        // Update your chat UI with the new message
        let messageContainer = document.getElementById('messages-container');
        let newMessageElement = document.createElement('div');
        newMessageElement.classList.add('message');
        newMessageElement.innerText = event.chat.message; // Display the message content
        messageContainer.appendChild(newMessageElement);
    });
