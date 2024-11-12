<?php
// app/Broadcasting/ChatChannel.php
namespace App\Broadcasting;
use App\Models\User;
use App\Models\Chat;
class ChatChannel {
 
    public function join(User $user, Chat $chat) {
        // Authorization logic to check if the user can join the chat
        return $user->id === $chat->user_id || $user->id === $chat->friend_id;
    }

}