<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::channel('chat.{friendId}', function (User $user, $friendId) {
    return $user->id === (int) $friendId || $user->friends()->where('friend_id', $friendId)->exists();
});Broadcast::channel('chats.{friendId}', function (User $user, $friendId) {
    return $user->id === (int) $friendId || $user->friends()->where('friend_id', $friendId)->exists();
});