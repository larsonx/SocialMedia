import axios from 'axios';
import './echo';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


window.Echo.private(`chat.${friendId}`)
    .listen('MessageSent', (e) => {
        // Display the incoming message (e.message) on the chat UI
        console.log('Message received:', e.message);
        // Update your UI with the new message
    });