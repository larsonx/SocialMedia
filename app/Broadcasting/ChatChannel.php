<?php
// app/Broadcasting/ChatChannel.php
namespace App\Broadcasting;

use App\Models\User;

class ChatChannel {
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @param  int  $friendId
     * @return array|bool
     */
    public function join(User $user, $friendId) {
        // Check if the user is friends with the friendId
        return $user->friends()->where('friend_id', $friendId)->exists();
    }
}