import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
 
const options = {
    broadcaster: 'pusher',
    key: 'your-pusher-channels-key'
}
 
window.Echo = new Echo({
    ...options,
    client: new Pusher(options.key, options)
});