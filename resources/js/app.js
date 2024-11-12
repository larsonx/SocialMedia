import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Echo.channel('chat')
    .listen('MessageSent', (event) => {
        console.log(event.message);
        // Here you can update the chat UI by appending the new message
    });
