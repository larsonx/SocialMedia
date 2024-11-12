<?php
// app/Broadcasting/ChatChannel.php
namespace App\Broadcasting;
use App\Models\User;

class ChatChannel {
    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @param  int  $friendId
     * @return bool
     */
    public function join(User $user, $friendId) {
        // Check if the user is friends with the given friendId
        return $user->friends()->where('friend_id', $friendId)->exists();
    }
}